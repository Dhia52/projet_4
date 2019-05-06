<?php

namespace projets_developpeur_web\projet_4\Controller;

use projets_developpeur_web\projet_4\Model\Managers as Managers;
use projets_developpeur_web\projet_4\Model\Classes\Comment;
use projets_developpeur_web\projet_4\Model as Model;
use projets_developpeur_web\projet_4\Framework as Framework;
use projets_developpeur_web\projet_4 as project;


class CommentsController extends Framework\Controller
{
	protected $commentManager;

	public function __construct()
	{
		$this->commentManager = Managers\Manager::setManager('CommentManager', Framework\Configuration::get('DB_API'));
	}

	public function post()
	{
		$list = $this->episodeManager->getList();
		$this->createView(array('list' => $list));
	}

	public function edit()
	{
		if(isset($_GET['id']))
		{
			if(isset($_POST['comment']))
			{
				$updatedComment = new Comment(array(
					'id' => $_GET['id'],
					'comment' => $_POST['comment']));
				$this->commentManager->update($updatedComment);
				header('Location: .?controller=episodes&action=read&id=' . $_GET['id']);
			}
			else
			{
				$commentId = $_GET['id'];
				if($this->commentManager->exists($commentId))
				{
					$comment = $this->commentManager->getComment($commentId);
					if($_SESSION['id'] === $comment->authorId())
					{
						$this->createView(array('comment' => $comment));
					}
					else
					{
						throw new \Exception('Unauthorised action');
					}
				}
				else
				{
					throw new \Exception('Comment not found');
				}
			}
		}
		else
		{
			throw new \Exception('No id argument given for comment');
		}
	}

	public function delete()
	{
	}

	public function index()
	{
		header('Location: .');
	}
}
