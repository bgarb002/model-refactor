<?php
namespace Zumba\User\Contract;

interface Searchable {

	public function search(SearchObject $params) : Collection;
}