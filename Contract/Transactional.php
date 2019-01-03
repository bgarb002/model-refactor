<?php
namespace Zumba\User\Contract;

interface Transactional {

	public function start() : void;

	public function commit() : void;

	public function rollback() : void;
}