<?php

namespace App\Repositories;

use App\Models\Todo;

class TodoRepository
{
    protected $todo;
    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    public function getAll(): object
    {
        $todo = $this->todo->get();
        return $todo;
    }

    public function store($data): object
    {
        $newTodo = new $this->todo;
        $newTodo->title = $data['title'];
        $newTodo->desc = $data['desc'];
        $newTodo->save();
        return $newTodo->fresh();
    }
}
