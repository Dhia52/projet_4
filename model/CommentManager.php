<?php

abstract class CommentManager
{
	abstract public function getList(int $id, $class);
	abstract public function getComment($id);
	abstract public function post(Comment $comment);
	abstract public function update(Comment $comment);
	abstract public function delete($id);
	abstract public function exists($info);
}
