<?php

abstract class CommentManager
{
	abstract public function getList($episodeId);
	abstract public function getComment($id);
	abstract public function post(Comment $comment);
	abstract public function update(Comment $comment);
	abstract public function delete($id);
	abstract public function exists($info);
}
