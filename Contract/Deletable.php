<?php
namespace Zumba\User\Contract;

interface Deletable {

	public function delete(string $reference) : void;
}