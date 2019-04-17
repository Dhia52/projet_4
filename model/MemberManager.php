<?php

//namespace openclassrooms\dwj\projet4\bani\model;

abstract class MemberManager
{
	abstract public function getList();
	abstract public function getMember($info);
	abstract public function create(Member $member);
	abstract public function update($memberId, array $updates);
	abstract public function delete($id);
	abstract public function exists($info);
	abstract public function count();
}
