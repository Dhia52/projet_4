<?php

namespace projets_developpeur_web\projet_4\Model\Managers\MemberManager;

use projets_developpeur_web\projet_4\Model\Classes\Member;

class PDO_MemberManager extends MemberManager
{
	public function getList($id = NULL)
	{
		$list = [];

		if(isset($id) && $id > 0)
		{
			$q = $this->db->prepare('SELECT pseudo FROM members WHERE id <> :id');
			$q->bindValue(':id', $id, \PDO::PARAM_INT);
			$q->execute();

			while($pseudo = $q->fetchColumn())
			{
				$list[] = $pseudo;
			}
		}
		else
		{
			$q = $this->db->query('SELECT * FROM members ORDER BY category, id');
			while($data = $q->fetch(\PDO::FETCH_ASSOC))
			{
				$list[] = new Member($data);
			}
		}

		return $list;
	}

	public function getMember($info)
	{
		if(is_int($info))
		{
			$q = $this->db->prepare('SELECT * FROM members WHERE id = :id');
			$q->bindValue(':id', $info, \PDO::PARAM_INT);
			$q->execute();

			$memberData = $q->fetch(\PDO::FETCH_ASSOC);
		}
		else
		{
			$q = $this->db->prepare('SELECT * FROM members WHERE pseudo = :pseudo');
			$q->bindValue(':pseudo', $info, \PDO::PARAM_STR);
			$q->execute();

			$memberData = $q->fetch(\PDO::FETCH_ASSOC);
		}

		return new Member($memberData);
	}

	public function create(Member $member)
	{
		$q = $this->db->prepare('INSERT INTO members (pseudo, password, signDate, lastConnexion) VALUES (:pseudo, :password, NOW(), NOW())');
		$q->bindValue(':pseudo', $member->pseudo(), \PDO::PARAM_STR);
		$q->bindValue(':password', $member->password(), \PDO::PARAM_STR);
		$q->execute();
	}

	public function update($memberId, array $updates)
	{
		foreach($updates as $key => $value)
		{
			switch($key)
			{
			case 'category':
				$request = 'UPDATE members SET category = :category WHERE id = :id';
				$column = ':category';
				$newValue = $value;
				$type = \PDO::PARAM_STR;
				break;

			case 'pseudo':
				$request = 'UPDATE members SET pseudo = :pseudo WHERE id = :id';
				$column = ':pseudo';
				$newValue = $value;
				$type = \PDO::PARAM_STR;
				break;

			case 'email':
				$request = 'UPDATE members SET email = :email WHERE id = :id';
				$column = ':email';
				$newValue = $value;
				$type = \PDO::PARAM_STR;
				break;

			case 'password':
				$request = 'UPDATE members SET password = :password WHERE id = :id';
				$column = ':password';
				$newValue = $value;
				$type = \PDO::PARAM_STR;
				break;

			case 'lastConnexion':
				$request = 'UPDATE members SET lastConnexion = NOW() WHERE id = :id';
				break;

			case 'nb_reports':
				$request = 'UPDATE members SET nb_reports = :nb_reports WHERE id = :id';
				$column = ':nb_reports';
				$newValue = $value;
				$type = \PDO::PARAM_INT;
				break;
			}

			$q = $this->db->prepare($request);
			$q->bindValue(':id', $memberId, \PDO::PARAM_INT);
			if(isset($column)) //considering last connexion case
			{
				$q->bindValue($column, $newValue, $type);
			}
			$q->execute();
		}
	}
	
	public function delete($id)
	{
		$q = $this->db->prepare('DELETE FROM members WHERE id = :id');
		$q->bindValue(':id', $id, \PDO::PARAM_INT);
		$q->execute();
	}

	public function exists($info)
	{
		if(is_int($info))
		{
			$q = $this->db->prepare('SELECT COUNT(*) FROM members WHERE id = :id');
			$q->bindValue(':id', $info, \PDO::PARAM_INT);
			$q->execute();
		}
		else
		{
			$q = $this->db->prepare('SELECT COUNT(*) FROM members WHERE pseudo = :pseudo');
			$q->bindValue(':pseudo', $info, \PDO::PARAM_STR);
			$q->execute();
		}
		return (bool) $q->fetchColumn();
	}

	public function count()
	{
		$q = $this->db->query('SELECT COUNT(*) FROM members');
		return $q->fetchColumn();
	}
}
