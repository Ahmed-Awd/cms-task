<?php

namespace App\Repositories;

use App\Models\Attribute;

class AttributeRepository extends BaseRepository
{
    public function __construct(Attribute $attribute, $searchColumns = [], $selects = [])
    {
        $searchColumns = ["name"];
        parent::__construct($attribute, $searchColumns, $selects);
    }
}
