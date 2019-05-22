<?php

namespace projets_developpeur_web\projet_4\Model\Managers\EpisodeManager;

use projets_developpeur_web\projet_4\Model\Managers\Manager;
use projets_developpeur_web\projet_4\Model\Classes\Episode;

abstract class EpisodeManager extends Manager
{
	abstract public function getList();
	abstract public function getEpisode($info);
	abstract public function post(Episode $episode);
	abstract public function update(array $data, int $episodeId);
	abstract public function delete($id);
	abstract public function count();
	abstract public function exists(int $id);
}
