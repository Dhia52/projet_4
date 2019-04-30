<?php

namespace projets_developpeur_web\projet_4\model\Managers\MemberManager;

use projets_developpeur_web\projet_4\model\Managers as Managers;

abstract class MemberManager extends Managers\Manager
{
	abstract public function getList();
	abstract public function getMember($info);
	abstract public function create(Member $member);
	abstract public function update($memberId, array $updates);
	abstract public function delete($id);
	abstract public function exists($info);
	abstract public function count();
}