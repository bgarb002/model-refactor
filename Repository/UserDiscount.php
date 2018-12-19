<?php
namespace Zumba\User\Repository;

use \Zumba\User\Contract\Savable,
	\Zumba\User\Contract\Transactional,
	\Zumba\User\Contract\SavableEntity,
	\Zumba\User\Contract\User;

class UserDiscount implements Savable, Transactional {

	public function save(SavableEntity $entity, User $byUser): void
	{
		// TODO: Implement save() method.
	}

	public function start(): void
	{
		// TODO: Implement start() method.
	}

	public function commit(): void
	{
		// TODO: Implement commit() method.
	}

	public function rollback(): void
	{
		// TODO: Implement rollback() method.
	}


}
