<?php
namespace Zumba\User\Factory;

use \Zumba\User\Contract\Command;

class Repo {

	public static function build(string $name) { //Should return some type of Repo
		$class = "\Zumba\User\Repository\$name";
		return new $class();
	}
}
