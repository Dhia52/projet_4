<?php

class PDO_MemberManager extends MemberManager
{
	protected $db;

	public function __construct(PDO $db)
	{
		$this->setDb($db);
	}

	public function setDb(PDO $db)
	{
		$this->db = $db;
	}

	public function getList(){}

	public function getMember($info)
	{
		if(is_int($info))
		{
			$q = $this->db->prepare('SELECT * FROM members WHERE id = :id');
			$q->bindValue(':id', $info, PDO::PARAM_INT);
			$q->execute();

			$memberData = $q->fetch(PDO::FETCH_ASSOC);
		}
		else
		{
			$q = $this->db->prepare('SELECT * FROM members WHERE pseudo = :pseudo');
			$q->bindValue(':pseudo', $info, PDO::PARAM_STR);
			$q->execute();

			$memberData = $q->fetch(PDO::FETCH_ASSOC);
		}

		return new Member($memberData);
	}

	public function create(Member $member)
	{
		$q = $this->db->prepare('INSERT INTO members (pseudo, password, signDate, lastConnexion) VALUES (:pseudo, :password, NOW(), NOW())');
		$q->bindValue(':pseudo', $member->pseudo(), PDO::PARAM_STR);
		$q->bindValue(':password', $member->pass(), PDO::PARAM_STR);
		$q->execute();
	}

	public function update(Member $member){}
	public function delete($id){}
	public function exists($info)
	{
		$q = $this->db->prepare('SELECT COUNT(*) FROM members WHERE pseudo = :pseudo');
		$q->bindValue(':pseudo', $info, PDO::PARAM_STR);
		$q->execute();

		return (bool) $q->fetchColumn();
	}
}
