<?php
namespace Zumba\User\Controller;

class Discount extends BaseController {

	public function postUserDiscount() : void {
		$service = Service::build('UserDiscountCreate', $this->request->params());
		$service->execute();
	}
}
