<?php
namespace Zumba\User\Repository;

use\Zumba\User\Contract\Transactional,
	\Zumba\User\Contract\SavableEntity,
	\Zumba\User\Contract\User,
	\Zumba\User\Contract\Event;

class EventQueueDB implements Transactional, Event {
	public function start(): void
	{
		DB::begin();
	}

	public function commit(): void
	{
		DB::commit();
	}

	public function rollback(): void
	{
		DB::rollback();
	}

	public function trigger(string $event, array $data): void
	{
		//insert into event_queues table
	}


}
