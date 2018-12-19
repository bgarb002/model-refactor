<?php
namespace Zumba\User\Service;

use \Zumba\User\Contract\Command,
	\Zumba\User\Factory\EventQueueRepo,
	\Zumba\User\Factory\Repo,
	\Zumba\User\Contract\Transactional;

class UserDiscountCreate implements Command, Transactional {

	private $params = [];

	//probally should be a repo collection
	private $repos = [];

	public function __construct(array $params) {
		//validate params
		$this->params = $params;

		$this->loadRepo('User');
		$this->loadRepo('Discount');
		$this->loadRepo('MembershipTypeGroup');
		$this->loadRepo('UserDiscount');

		$this->repos['EventQueue'] = EventQueueRepo::build();


	}

	private function loadRepo(string $name) {
		$this->repos[$name] = Repo::build($name);
	}

	private function getRepo(string  $name) {
		return $this->repos[$name];
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

	public function start(): void
	{
		foreach ($this->repos as $r) {
			if ($r instanceof  Transactional) {
				$r->start();
			}
		}
	}

	public function commit(): void
	{
		foreach ($this->repos as $r) {
			if ($r instanceof  Transactional) {
				$r->commit();
			}
		}
	}

	public function rollback(): void
	{
		foreach ($this->repos as $r) {
			if ($r instanceof  Transactional) {
				$r->rollback();
			}
		}
	}


}
