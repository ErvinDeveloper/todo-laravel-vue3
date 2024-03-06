<?php

namespace App\Http\Controllers;

use App\Facades\Task;
use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Repositories\Task\TaskRepositoryContract;
use Illuminate\Http\JsonResponse;


class TaskController extends Controller
{

    public function __construct(private readonly TaskRepositoryContract $repository)
    {
    }

    public function index(): JsonResponse
    {
        return response()->json(
            $this->repository->getForList()
        );
    }

    public function indexGetSorted(string $column, string $order): JsonResponse
    {
        return response()->json(
            $this->repository->getForListWithSorting($column, $order)
        );
    }

    public function store(StoreRequest $request): JsonResponse
    {
        return response()->json(
            Task::store($request)
        );
    }

    public function update(int $taskId, UpdateRequest $request): JsonResponse
    {
        $task = $this->repository->findById($taskId);
        if (empty($task)) {
            return response()->json([
                'error' => 'Task not found'
            ], 404);
        }

        return response()->json([
            'isUpdated' => Task::update($task, $request)
        ]);
    }

    public function destroy(int $taskId): JsonResponse
    {
        $task = $this->repository->findById($taskId);
        if (empty($task)) {
            return response()->json([
                'error' => 'Task not found'
            ], 404);
        }

        return response()->json([
            'isDeleted' => Task::delete($task)
        ]);
    }
}
