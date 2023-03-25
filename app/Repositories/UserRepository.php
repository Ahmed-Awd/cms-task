<?php

namespace App\Repositories;



use App\Models\User;

class UserRepository extends BaseRepository
{
    public function __construct(User $user, $searchColumns = [], $selects = [])
    {
        $searchColumns = ["name"];
        parent::__construct($user, $searchColumns, $selects);
    }

    public function getWithRole(
        $role,
        $filters = [],
        $search = false,
        $with = false,
        $selects = false,
        $range = false,
        $rangeBy = "created_at",
        $orderBy = "id",
        $order = "asc",
        $withPagination = true,
        $count = 15
    ) {
        $filters = $this->prepareFilters($filters);
        $query = $this->model->role($role);
        $query = $query->where($filters);
        $query = $this->doSelect($query, $selects);
        $search == false ? $query : $query = $this->search($query, $search);
        $range == false ? $query : $query = $this->dateFilter($query, $range, $rangeBy);
        $with == false ? $query : $query = $query->with($with);
        $query->orderBy($orderBy, $order);
        $withPagination == true ? $query = $query->paginate($count) : $query = $query->get();
        return $query;
    }

    public function assignRole($user, $role)
    {
        $user->assignRole($role);
    }
}
