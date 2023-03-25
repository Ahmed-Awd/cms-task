<?php

namespace App\Repositories;

use App\Models\Record;

class RecordRepository extends BaseRepository
{
    public function __construct(Record $record, $searchColumns = [], $selects = [])
    {
        $searchColumns = [];
        parent::__construct($record, $searchColumns, $selects);
    }
}
