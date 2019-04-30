<?php

namespace projets_developpeur_web\projet_4\Model\Managers\CommentManager;

use projets_developpeur_web\projet_4\Model\Managers as Managers;
use projets_developpeur_web\projet_4\Model\Classes as Classes;

abstract class CommentManager extends Managers\Manager
{
	abstract public function getList(int $id, $class);
	abstract public function getComment($id);
	abstract public function post(Classes\Comment $comment);
	abstract public function update(Classes\Comment $comment);
	abstract public function delete($id);
	abstract public function exists($info);
	abstract public function count(int $id, $class);
}
