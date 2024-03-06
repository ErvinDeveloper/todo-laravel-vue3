<?php

namespace App\Repositories\Task;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class TaskRepository implements TaskRepositoryContract
{
    public function getForList(): Collection
    {
        return Task::query()->selectForList()->get();
    }

    public function getForListWithSorting(string $column, string $order): Collection
    {
        return Task::query()->selectForList()->orderBy($column, $order)->get();
    }

    public function findById(int $id): ?Model
    {
        return Task::query()->where('id', $id)->first();
    }


}
