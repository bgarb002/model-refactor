<?php
namespace Zumba\User\Factory;

use \Zumba\User\Contract\Command;

class UserDiscount {

	public static function build(User $user, Discount $discount, MembershipTypeGroup $memTypeGroup, User $byUser) : UserDiscount {
		return new UserDiscount($user, $discount, $memTypeGroup, $byUser);
	}
}
