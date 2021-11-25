<?php
namespace Database\Seeders;

use App\Models\TaskTest;
use Illuminate\Database\Seeder;

class TaskTestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * https://leetcode.com/problems/first-missing-positive/
     *
     * @return void
     */
    public function run()
    {
        // 1
        TaskTest::create([
            'task_id' => 1,
            'params' => '[[2,7,11,15], 9]',
            'result' => '[0,1]',
        ]);
        TaskTest::create([
            'task_id' => 1,
            'params' => '[[3,2,4], 6]',
            'result' => '[1,2]',
        ]);
        TaskTest::create([
            'task_id' => 1,
            'params' => '[[3,3], 6]',
            'result' => '[0,1]',
        ]);

        // 2
        TaskTest::create([
            'task_id' => 2,
            'params' => '[[2,4,3], [5,6,4]]',
            'result' => '[7,0,8]',
        ]);
        TaskTest::create([
            'task_id' => 2,
            'params' => '[[0], [0]]',
            'result' => '[0]',
        ]);
        TaskTest::create([
            'task_id' => 2,
            'params' => '[[9,9,9,9,9,9,9], [9,9,9,9]]',
            'result' => '[8,9,9,9,0,0,0,1]',
        ]);

        // 3
        TaskTest::create([
            'task_id' => 3,
            'params' => '["abcabcbb"]',
            'result' => '3',
        ]);
        TaskTest::create([
            'task_id' => 3,
            'params' => '["bbbbb"]',
            'result' => '1',
        ]);
        TaskTest::create([
            'task_id' => 3,
            'params' => '["pwwkew"]',
            'result' => '3',
        ]);
        TaskTest::create([
            'task_id' => 3,
            'params' => '[""]',
            'result' => '0',
        ]);

        // 4
        TaskTest::create([
            'task_id' => 4,
            'params' => '[[1,3], [2]]',
            'result' => '2.00000',
        ]);
        TaskTest::create([
            'task_id' => 4,
            'params' => '[[1,2], [3,4]]',
            'result' => '2.50000',
        ]);
        TaskTest::create([
            'task_id' => 4,
            'params' => '[[0,0], [0,0]]',
            'result' => '0.00000',
        ]);
        TaskTest::create([
            'task_id' => 4,
            'params' => '[[], [1]]',
            'result' => '1.00000',
        ]);
        TaskTest::create([
            'task_id' => 4,
            'params' => '[[2], []]',
            'result' => '2.00000',
        ]);
        TaskTest::create([
            'task_id' => 4,
            'params' => '[[2, 3, 5, 8], [10, 12, 14, 16, 18, 20]]',
            'result' => '11.00000',
        ]);
        TaskTest::create([
            'task_id' => 4,
            'params' => '[[-5, 3, 6, 12, 15], [-12, -10, -6, -3, 4, 10]]',
            'result' => '3.00000',
        ]);

        // 5
        TaskTest::create([
            'task_id' => 5,
            'params' => '["babad"]',
            'result' => 'bab',
        ]);
        TaskTest::create([
            'task_id' => 5,
            'params' => '["cbbd"]',
            'result' => 'bb',
        ]);
        TaskTest::create([
            'task_id' => 5,
            'params' => '["a"]',
            'result' => 'a',
        ]);
        TaskTest::create([
            'task_id' => 5,
            'params' => '["ac"]',
            'result' => 'a',
        ]);

        // 6
        TaskTest::create([
            'task_id' => 6,
            'params' => '["PAYPALISHIRING", 3]',
            'result' => 'PAHNAPLSIIGYIR',
        ]);
        TaskTest::create([
            'task_id' => 6,
            'params' => '["PAYPALISHIRING", 4]',
            'result' => 'PINALSIGYAHRPI',
        ]);
        TaskTest::create([
            'task_id' => 6,
            'params' => '["A", 1]',
            'result' => 'A',
        ]);

        // 7
        TaskTest::create([
            'task_id' => 7,
            'params' => '[123]',
            'result' => '321',
        ]);
        TaskTest::create([
            'task_id' => 7,
            'params' => '[-123]',
            'result' => '-321',
        ]);
        TaskTest::create([
            'task_id' => 7,
            'params' => '[120]',
            'result' => '21',
        ]);
        TaskTest::create([
            'task_id' => 7,
            'params' => '[0]',
            'result' => '0',
        ]);
    }
}
