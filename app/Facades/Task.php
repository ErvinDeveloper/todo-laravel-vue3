<?php

namespace App\Facades;

use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use Illuminate\Support\Facades\Facade;

/**
 * @method static store(StoreRequest $request)
 * @method static update(\App\Models\Task $task, UpdateRequest $request)
 * @method static delete(\App\Models\Task $task)
 */

class Task extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'task';
    }
}
