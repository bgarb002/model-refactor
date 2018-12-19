<?php
namespace Zumba\User\Contract;

interface Savable {

	//@question: is by user always required?
	public function save(SavableEntity $entity, User $byUser) : void;
}
