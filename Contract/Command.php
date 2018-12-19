<?php
namespace Zumba\User\Contract;

interface Command {

	public function execute() : void;
}
