<?php

namespace projets_developpeur_web\projet_4\Model\Managers\EpisodeManager;

use projets_developpeur_web\projet_4\Model\Managers as Managers;
use projets_developpeur_web\projet_4\Model\Classes as Classes;

abstract class EpisodeManager extends Managers\Manager
{
	abstract public function getList();
	abstract public function getEpisode($info);
	abstract public function post(Classes\Episode $episode);
	abstract public function update(Classes\Episode $episode);
	abstract public function delete($id);
	abstract public function exists(int $id);
}
