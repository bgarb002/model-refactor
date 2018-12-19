<?php
namespace Zumba\User\Contract;

interface Event {

	public function trigger(string $event, array $data) : void;
}
