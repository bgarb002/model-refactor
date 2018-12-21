<?php
namespace Zumba\User\Service;

use \Zumba\User\Factory\EventQueueRepo;

class UserDiscountCreate extends Command {

	private $params = [];

	public function __construct(array $params) {
		//validate params
		$this->params = $params;

		$this->loadRepo('User');
		$this->loadRepo('Discount');
		$this->loadRepo('MembershipTypeGroup');
		$this->loadRepo('UserDiscount');

		$this->repos['EventQueue'] = EventQueueRepo::build();


	}

	public function execute() : void {
		$user = $this->getRepo('User')->get($this->params['user_id']);
		$byUser = $this->getRepo('User')->get($this->params['by_user_id']);
		$discount = $this->getRepo('Discount')->get($this->params['discount_slug']);
		$memTypeGroup =$this->getRepo('MembershipGroupType')->get($this->params['membership_type_group_id']);
		$userDiscount = UserDiscount::build($user, $discount, $memTypeGroup, $byUser);

		try {
			$this->start();
			$this->getRepo('UserDiscount')->save($userDiscount);
			$this->getRepo('EventQueue')->trigger('UserDiscountSaved', $userDiscount->toArray());
			$this->commit();
		} catch (\Exception $e) {
			$this->rollback();
		}

	}


}
