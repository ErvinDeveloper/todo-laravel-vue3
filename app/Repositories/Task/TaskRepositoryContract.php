<?php
namespace App\Repositories\Task;

use Illuminate\Database\Eloquent\Collection;

interface TaskRepositoryContract
{
    public function getForList(): Collection;

    public function getForListWithSorting(string $column, string $order): Collection;

    public function findById(int $id);
}
