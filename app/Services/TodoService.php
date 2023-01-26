<?php

namespace App\Services;

use InvalidArgumentException;
use App\Repositories\TodoRepository;
use Illuminate\Support\Facades\Validator;

class TodoService
{
    protected $todoRepository;
    public function __construct(TodoRepository $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function getAll()
    {
        $todo = $this->todoRepository->getAll();
        return $todo;
    }

    public function store($data)
    {
        $validator = Validator::make($data, [
            'title' => 'required',
            'desc' => 'required'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $result = $this->todoRepository->store($data);
        return $result;
    }
}
