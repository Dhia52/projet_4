<?php

namespace projets_developpeur_web\projet_4\Model\Managers\MemberManager;

use projets_developpeur_web\projet_4\Model\Classes\Member;

class MySQLi_MemberManager extends MemberManager
{
	public function getList()
	{
		$list = [];

		$q = $this->db->query('SELECT * FROM members ORDER BY category, id');

		while($data = $q->fetch_assoc())
		{
			$list[] = new Member($data);
		}

		return $list;
	}

	public function getMember($info)
	{
		if(is_int($info))
		{
			$q = $this->db->prepare('SELECT * FROM members WHERE id = ?');
			$q->bind_param('i', $info);
			$q->execute();

			$memberData = $q->get_result()->fetch_assoc();
		}
		else
		{
			$q = $this->db->prepare('SELECT * FROM members WHERE pseudo = ?');
			$q->bind_param('s', $info);
			$q->execute();

			$memberData = $q->get_result()->fetch_assoc();
		}

		return new Member($memberData);
	}

	public function create(Member $member)
	{
		$pseudo = $member->pseudo();
		$password = $member->password();

		$q = $this->db->prepare('INSERT INTO members (pseudo, password, signDate, lastConnexion) VALUES (?, ?, NOW(), NOW())');
		$q->bind_param('ss', $pseudo, $password);
		$q->execute();
	}

	public function update($id, array $updates)
	{
		foreach($updates as $key => $value)
		{
			switch($key)
			{
			case "category":
				$request = 'UPDATE members SET category = ? WHERE id = ?';
				$type = 'si';
				$parameters = "$value, $id";
				break;

			case "pseudo":
				$request = 'UPDATE members SET pseudo = ? WHERE id = ?';
				$type = 'si';
				$parameters = "$value, $id";
				break;

			case "password":
				$request = 'UPDATE members SET password = ? WHERE id = ?';
				$type = 'si';
				$parameters = "$value, $id";
				break;

			case "lastConnexion":
				$request = 'UPDATE members SET lastConnexion = NOW() WHERE id = ?';
				$type = 'i';
				$parameters = $id;
				break;

			case "nb_reports":
				$request = 'UPDATE members SET nb_reports = ? WHERE id = ?';
				$type = 'ii';
				$parameters = "$value, $id";
				break;
			}
			
			$q = $this->db->prepare($request);
			$q->bind_param($type, $parameters);
			$q->execute();
		}
	}

	public function delete($id){}
	public function exists($info)
	{
		if(is_int($info))
		{
			$q = $this->db->prepare('SELECT id FROM members WHERE id = ?');
			$q->bind_param('i', $info);
			$q->execute();
		}
		else
		{
			$q = $this->db->prepare('SELECT pseudo FROM members WHERE pseudo = ?');
			$q->bind_param('s', $info);
			$q->execute();
		}

		return $q->fetch();
	}

	public function count()
	{
		$result = $this->db->query('SELECT COUNT(*) AS Members FROM members');
		$count = $result->fetch_assoc();
		return $count['Members'];
	}
}
