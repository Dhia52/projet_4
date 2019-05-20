<?php

namespace projets_developpeur_web\projet_4\Controller;

use projets_developpeur_web\projet_4\Model\Managers\Manager;
use projets_developpeur_web\projet_4\Model\Classes\Comment;
use projets_developpeur_web\projet_4\Framework\Controller;
use projets_developpeur_web\projet_4\Framework\Configuration;


class CommentsController extends Controller
{
	protected $commentManager;

	public function __construct()
	{
		$this->commentManager = Manager::setManager('CommentManager', Configuration::get('DB_API'));
	}

	public function post()
	{
		if(isset($_SESSION['id']) && $this->request->exists('id'))
		{
			if($this->request->exists('newComment'))
			{
				$episodeId = (int) $this->request->getParam('id');
				$comment = new Comment(array(
					'comment' => $this->request->getParam('newComment'),
					'authorId' => $_SESSION['id'],
					'episodeId' => $episodeId));
				$this->commentManager->post($comment);

				header('Location: .?controller=episodes&action=read&id=' . $episodeId);
			}
			else
			{
				throw new \Exception('Cannot post empty comment');
			}
		}
		else
		{
			throw new \Exception('Impossible request');
		}
	}

	public function edit()
	{
		if($this->request->exists('id'))
		{
			if($this->request->exists('comment'))
			{
				$updatedComment = new Comment(array(
					'id' => $this->request->getParam('id'),
					'comment' => $this->request->getParam('comment')));
				$this->commentManager->update($updatedComment, 'edit');
				$episodeId = $this->commentManager->getComment($updatedComment->id())->episodeId();
				header('Location: .?controller=episodes&action=read&id=' . $episodeId);
			}
			else
			{
				$commentId = $this->request->getParam('id');
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
		if(isset($_SESSION['category']))
		{
			if($this->request->exists('id'))
			{
				$commentId = (int) $this->request->getParam('id');
				if($this->commentManager->exists($commentId))
				{
					$comment = $this->commentManager->getComment($commentId);
					if($_SESSION['id'] === $comment->authorId() || \in_array($_SESSION['category'], ['Admin', 'Writer', 'Mod']))
					{
						$this->commentManager->delete($commentId);
						\header('Location: .?controller=episodes&action=read&id=' . $comment->episodeId());
					}
					else
					{
						throw new \Exception('Unauthorised action');
					}
				}
				else
				{
					throw new \Exception('Comment does not exist');
				}
			}
			else
			{
				\header('Location: .?controller=episodes&action=list');
			}
		}
		else
		{
			throw new \Exception('Unauthorised action');
		}
	}

	public function report()
	{
		if(isset($_SESSION['category']))
		{
			if($this->request->exists('id'))
			{
				$commentId = (int) $this->request->getParam('id');

				if($this->commentManager->exists($commentId))
				{
					$comment = $this->commentManager->getComment($commentId);
					$episodeId = $comment->episodeId();
					if(!$comment->reported())
					{
						$this->commentManager->update($comment, 'report');
					}
					else
					{
						if(\in_array($_SESSION['category'], ['Admin', 'Writer', 'Mod']))
						{
							$this->commentManager->update($comment, 'unreport');
						}
						else
						{
							throw new \Exception('Unauthorised action');
						}
					}
					header('Location: .?controller=episodes&action=read&id=' . $episodeId);
				}
				else
				{
					throw new \Exception('Comment not found');
				}
			}
			else
			{
				throw new \Exception('Missing comment id');
			}
		}
		else
		{
			throw new \Exception('Unauthorised action');
		}
	}

	public function index()
	{
		header('Location: .');
	}
}
