<?php

abstract class MemberManager
{
	abstract public function getList();
	abstract public function getMember($info);
	abstract public function create(member $member);
	abstract public function update(member $member);
	abstract public function delete($id);
	abstract public function exists($info);
}
