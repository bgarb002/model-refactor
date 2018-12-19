<?php
namespace Zumba\User\Service;

use \Zumba\User\Contract\Command;

class UserDiscountCreate implements Command {

	private $params = [];

	public function __construct(array $params) {
		//validate params
		$this->params = $params;
	}

	public function execute() : void {
		$user = Repo::build('User')->get($this->params['user_id']);
		$byUser = Repo::build('User')->get($this->params['by_user_id']);
		$discount = Repo::build('Discount')->get($this->params['discount_slug']);
		$memTypeGroup = Repo::build('MembershipTypeGroup')->get($this->params['membership_type_group_id']);
		$userDiscount = UserDiscount::build($user, $discount, $memTypeGroup, $byUser);
		Repo::build('UserDiscount')->save($userDiscount);
	}
}
