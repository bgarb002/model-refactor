<?php
namespace Zumba\User\Factory;

use \Zumba\User\Contract\Command;

class Service {

	public static function build(string $name, array $params = []) : Command {
		$class = "\Zumba\User\Service\$name";
		return new $class($params);
	}
}
