<?php

namespace App\Http\Controllers;

use App\Models\Solution;
use App\Models\TaskTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SolutionController extends Controller
{
    public function apiSave(Request $request)
    {
        if (!$request->get('action') || !in_array($request->get('action'), ['save', 'update'])) {
            return response()->json([
                'type' => 'error',
                'messages' => ['Unknown action'],
            ], 404);
        }

        if ($request->get('action') === 'save') {
            $validator = Validator::make(
                $request->all(),
                [
                    'task_id' => [
                        'required',
                        'integer',
                    ],
                    'language' => [
                        'required',
                    ],
                    'solution' => [
                        'required',
                    ],
                ],
                [
                    'task_id.required' => "Task not found.",
                    'task_id.integer' => "Task must be integer.",
                    'language.required' => "Solution language not found.",
                    'solution.required' => "Solution is required.",
                ]
            );
        } else {
            $validator = Validator::make(
                $request->all(),
                [
                    'id' => [
                        'required',
                        'integer',
                    ],
                    'solution' => [
                        'required',
                    ],
                ],
                [
                    'id.required' => "Solution not found.",
                    'id.integer' => "Solution id must be integer.",
                    'solution.required' => "Solution is required.",
                ]
            );
        }

        if ($validator->fails()) {
            return response()->json([
                'type' => 'error',
                'messages' => $validator->errors()->all(),
            ], 500);
        }

        if ($request->get('action') === 'save') {
            Solution::create([
                'task_id' => $request->get('task_id'),
                'language' => $request->get('language'),
                'solution' => $request->get('solution'),
            ]);

            $sol = Solution::where('task_id', $request->get('task_id'))
                ->where('solution', $request->get('solution'))
                ->where('language', $request->get('language'))
                ->get()
                ->last();
        } else {
            Solution::find($request->get('id'))->update([
                'solution' => $request->get('solution'),
            ]);

            $sol = Solution::find($request->get('id'));
        }

        return response()->json(['type' => 'success', 'message' => 'Solution saved!', 'data' => $sol], 200);
    }

    public function apiGetSolutions(int $task_id)
    {
        $solutions = Solution::where('task_id', $task_id)->get();

        return response()
            ->json(
                [
                    'type' => 'success',
                    'messages' => 'Solution loaded!',
                    'data' => $solutions->all(),
                ],
                200
            );
    }

    public function apiRun(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'task_id' => [
                    'required',
                    'integer',
                ],
                'language' => [
                    'required',
                ],
                'solution' => [
                    'required',
                    'max:2000',
                    'regex:/function\s*solution\s*\(/isU',
                ],
            ],
            [
                'task_id.required' => "Task is required.",
                'task_id.integer' => "Task must be integer.",
                'language.required' => "Solution language not found.",
                'solution.required' => "Solution is required.",
                'solution.regex' => 'Function should be named "solution".',
                'solution.max' => 'Function code is too big.',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'type' => 'error',
                'messages' => $validator->errors()->all(),
            ], 500);
        }

        $tests = [];
        $testChecks = TaskTest::where('task_id', $request->get('task_id'))->get()->all();

        switch ($request->get('language')) {
            case Solution::PHP:
                foreach ($testChecks as $test) {
                    $c = null;
                    $data = collect(json_decode($test->params))
                        ->map(function ($item) {
                          return is_array($item) ? json_encode($item) : (is_string($item) ? "'$item'" : $item);
                        })
                        ->implode(", ");
                    $code = '$c = new class {
                      function run(){ return $this->solution(' . $data . '); }
                      ' . $request->get('solution') . '
                    };';
                    
                    eval($code);
                    $result = (new $c())->run();
                    $result = is_array($result) ? json_encode($result, JSON_NUMERIC_CHECK) : $result;
                    $tests[] = [
                        'test' => 'Run solution with (' . substr(substr($test->params, 1), 0, -1) . '). Got ' . $result . ', expected ' . $test->result . '.',
                        'pass' => $result == $test->result,
                    ];
                }
                break;
            case Solution::JS:
                // prepare code to run in browser from method
                preg_match_all('/function\s+solution\s*\(([^\(]+)\)\s*\{(.+?)\}/isU', $request->get('solution'), $params);
                if (isset($params[1][0])) {
                    $jsParams = explode(",", $params[1][0]);
                    foreach ($testChecks as $test) {
                        $data = collect(json_decode($test->params))
                            ->map(function ($item, $index) use ($jsParams) {
                                $val = is_array($item) ? json_encode($item) : (is_string($item) ? "'$item'" : $item);
                                return ' let ' . trim($jsParams[$index]) . ' = ' . $val . ';';
                            })->implode(" ");
                        $tests[] = [
                            'code' => $data . $params[2][0],
                            'params' => substr($test->params, 1, -1),
                            'result' => $test->result,
                        ];
                    }
                } else {
                    $tests[] = [
                        'test' => 'JS function has errors.',
                        'pass' => false,
                    ];
                }
                break;

            default:
                return response()->json(['type' => 'error', 'messages' => ['Language not suported!']], 404);
        }

        return response()->json([
            'type' => 'success',
            'data' => $tests,
            'messages' => [
                'Code executed.',
            ],
        ], 200);
    }
}
