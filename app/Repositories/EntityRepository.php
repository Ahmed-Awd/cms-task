<?php


namespace App\Repositories;



use App\Models\Entity;
use Illuminate\Support\Facades\DB;

class EntityRepository extends BaseRepository
{
    public function __construct(Entity $entity, $searchColumns = [], $selects = [])
    {
        $searchColumns = ["name"];
        parent::__construct($entity, $searchColumns, $selects);
    }

    public function assignAttribute($entity,$attribute)
    {
        $entity->attributes()->syncWithoutDetaching($attribute);
    }

    public function removeAttribute($entity,$attribute)
    {
        DB::table("attribute_entity")->where("attribute_id",$attribute)->where("entity_id",$entity)->delete();
    }
}
