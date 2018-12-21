<?php
namespace Zumba\User\Service;

use \Zumba\User\Contract\Command as CommandInterface,
	\Zumba\User\Contract\Transactional;

abstract class Command implements CommandInterface, Transactional {


	//probally should be a repo collection
	protected $repos = [];


	protected function loadRepo(string $name) {
		$this->repos[$name] = Repo::build($name);
	}

	protected function getRepo(string  $name) {
		return $this->repos[$name];
	}


	public function start(): void
	{
		foreach ($this->repos as $r) {
			if ($r instanceof  Transactional) {
				$r->start();
			}
		}
	}

	public function commit(): void
	{
		foreach ($this->repos as $r) {
			if ($r instanceof  Transactional) {
				$r->commit();
			}
		}
	}

	public function rollback(): void
	{
		foreach ($this->repos as $r) {
			if ($r instanceof  Transactional) {
				$r->rollback();
			}
		}
	}


}
