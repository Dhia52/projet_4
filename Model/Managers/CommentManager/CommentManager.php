<?php

namespace projets_developpeur_web\projet_4\Model\Managers\CommentManager;

use projets_developpeur_web\projet_4\Model\Managers\Manager;
use projets_developpeur_web\projet_4\Model\Classes\Comment;

abstract class CommentManager extends Manager
{
	abstract public function getList(int $id, $class);
	abstract public function getComment($id);
	abstract public function post(Comment $comment);
	abstract public function update(Comment $comment, $action);
	abstract public function delete($id);
	abstract public function exists($info);
	abstract public function count(int $id, $class);
}
