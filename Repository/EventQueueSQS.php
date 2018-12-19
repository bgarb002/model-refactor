<?php
namespace Zumba\User\Repository;

use\Zumba\User\Contract\Transactional,
	\Zumba\User\Contract\SavableEntity,
	\Zumba\User\Contract\User,
	\Zumba\User\Contract\Event;

class EventQueueSQS implements Transactional, Event {
	private $useQueue = false;
	private $queue = [];

	public function start(): void
	{
		$this->useQueue = true;
	}

	public function commit(): void
	{
		foreach ($this->queue as $q) {
			$this->store($q);
		}

		$this->resetQueue();
	}


	private function store($q) {
		AWSSQS::insert($q);
	}

	private function resetQueue() {
		$this->queue = [];
		$this->useQueue = false;
	}

	public function rollback(): void
	{
		$this->resetQueue();
	}

	public function trigger(string $event, array $data): void
	{
		if ($this->useQueue) {
			array_push($this->queue, compact('event', 'data'));
		} else {
			$this->start(compact('event', 'data'));
		}
	}


}
