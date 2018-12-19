<?php
namespace Zumba\User\Contract;

interface Gettable {

	public function get(string $reference) : GettableEntity;
}
