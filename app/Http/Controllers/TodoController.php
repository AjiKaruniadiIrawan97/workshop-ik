<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TodoService;

class TodoController extends Controller
{
    protected $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function getTodoList()
    {
        try {
            $result = $this->todoService->getAll();
        } catch (\Exception $e) {
            $result = [
                'status' => 500,
                'message' => $e->getMessage()
            ];
        }
        return response()->json($result);
    }

    public function addTodo(Request $request)
    {
        $data = $request->all();
        $result = ['status' => 201];

        try {
            $result['data'] = $this->todoService->store($data);
        } catch (\Exception $e) {
            $result = [
                'status' => 422,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }
}
