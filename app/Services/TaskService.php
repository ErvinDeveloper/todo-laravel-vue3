<?php

namespace App\Services;

use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Models\Task;
use Illuminate\Database\Eloquent\Model;

class TaskService
{

    public function store(StoreRequest $request): Model
    {
        return Task::query()->create($request->validated());
    }

    public function update(Task $task, UpdateRequest $request): bool
    {
        return $task->update($request->validated());
    }

    public function delete(Task $task): ?bool
    {
        return $task->delete();
    }
}
