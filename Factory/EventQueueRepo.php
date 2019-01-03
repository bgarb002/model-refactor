<?php
namespace Zumba\User\Factory;

use \Zumba\User\Contract\Event;

class EventQueueRepo {

	public static function build() : Event { //Should return some type of Repo
		if (Config::isProd()) {
			return Repo::build('EventQueueSQS');
		}

		return Repo::build('EventQueueDB');
	}
}
