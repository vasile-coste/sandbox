<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function apiGetTasks(Request $request)
    {
        $tasks = Task::orderBy('id')
            ->where('name', 'like', '%'.$request->get('search').'%')
            ->paginate($request->get('ipp'), ['*'], 'page', $request->get('page'));

        return response()->json([
            'type' => 'success',
            'message' => 'Tasks loaded!',
            'data' => $tasks,
        ], 200);
    }
}
