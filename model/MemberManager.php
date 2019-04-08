<?php

abstract class MemberManager
{
	abstract public function getList();
	abstract public function getMember($info);
	abstract public function create(Member $member);
	abstract public function update(Member $member);
	abstract public function delete($id);
	abstract public function exists($info);
}
