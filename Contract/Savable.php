<?php
namespace Zumba\User\Contract;

interface Savable {

	public function save(SavableEntity $entity, User $byUser) : void;
}
