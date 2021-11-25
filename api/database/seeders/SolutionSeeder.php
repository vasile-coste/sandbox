<?php
namespace Database\Seeders;

use App\Models\Solution;
use Illuminate\Database\Seeder;

class SolutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Solution::create([
            'task_id' => 1,
            'language' => Solution::PHP,
            'solution' => 'function solution($nums, $target){
  $filter = array_filter($nums, function($n) use ($target){
    return $n <= $target;
  });
  $indexes = [];
  $stop = false;
  for($i = 0; $i < count($filter); $i++){
    if($stop){
      break;
    }
    for($j = 0; $j < count($filter); $j++){
      if($i !== $j){
        if($filter[$i] + $filter[$j] == $target){
          $indexes[] = $i;
          $indexes[] = $j;
          $stop = true;
          break;
        }
      }
    }
  }
  return $indexes;
}',
        ]);
        Solution::create([
            'task_id' => 1,
            'language' => Solution::JS,
            'solution' => 'function solution(nums, target){
  let filter = nums.filter(n => n <= target);
  let indexes = [];
  loop:
  for(let i = 0; i < filter.length; i++){
    for(let j = 0; j < filter.length; j++){
      if(i !== j){
        if(filter[i] + filter[j] == target){
          indexes.push(i);
          indexes.push(j);
          break loop;
        }
      }
    }
  }
  return indexes;
}',
        ]);

        Solution::create([
            'task_id' => 2,
            'language' => Solution::PHP,
            'solution' => 'function solution($l1, $l2) {
  $a1 = implode("", array_reverse($l1));
  $a2 = implode("", array_reverse($l2));

  $sumVal = $a1 + $a2;
  $resultArr = str_split($sumVal);

  return array_reverse($resultArr);
}',
        ]);
        Solution::create([
            'task_id' => 2,
            'language' => Solution::JS,
            'solution' => "function solution(l1, l2) {
  a1 = l1.reverse().join('');
  a2 = l2.reverse().join('');

  let sumVal = Number(a1) + Number(a2);
  const resultArr = String(sumVal).split('').map(item => Number(item));

  return resultArr.reverse();
}",
        ]);

        Solution::create([
            'task_id' => 3,
            'language' => Solution::PHP,
            'solution' => 'function solution($str) {
  $n = strlen($str);
  $res = 0;
  $visited = [];

  for($i = 0; $i < $n; $i++) {
    for($j = $i; $j < $n; $j++) {
      $letterIndex = substr($str, $j, 1);
      if(!isset($visited[$letterIndex])){
        $visited[$letterIndex] = false;
      }
      if ($visited[$letterIndex] == true){
        break;
      } else {
        $res = max($res, $j - $i + 1);
        $visited[$letterIndex] = true;
      }
    }

    $visited[substr($str, $i, 1)] = false;
  }
  return $res;
}',
        ]);

        Solution::create([
            'task_id' => 3,
            'language' => Solution::JS,
            'solution' => "function solution(str) {
  const n = str.length;
  let res = 0;
  let visited = [];

  for(let i = 0; i < n; i++) {
    for(let j = i; j < n; j++) {
      if (visited[str.charAt(j)] == true){
        break;
      } else {
        res = Math.max(res, j - i + 1);
        visited[str.charAt(j)] = true;
      }
    }

    visited[str.charAt(i)] = false;
  }
  return res;
}",
        ]);

        Solution::create([
            'task_id' => 4,
            'language' => Solution::JS,
            'solution' => "function solution(nums1, nums2){
  let arr = nums1.concat(nums2).sort((a, b) => a-b)
  if(arr.length % 2 == 0){
    return ((arr[arr.length / 2 - 1] + arr[arr.length / 2]) / 2).toFixed(5);
  }
  return (arr[Math.floor(arr.length / 2)]).toFixed(5);
}",
        ]);

        Solution::create([
            'task_id' => 5,
            'language' => Solution::JS,
            'solution' => "function solution(str) {
  if(str.length <= 1) {
    return str;
  }
  if(str.length == 2) {
    return str.charAt(0);
  }
  
  let palindrom = '';
  loop:
  for(let i = 0; i < str.length; i++) {
    for(let j = str.length - 1; j > i; j--) {
      if(str.charAt(i) === str.charAt(j)) {
          console.log(i, j + 1);
          palindrom = str.substring(i, j + 1);
          break loop;
      }
    }
  }
  return palindrom;
}",
        ]);

        Solution::create([
            'task_id' => 6,
            'language' => Solution::JS,
            'solution' => 'function solution(s, numRows) {
  if (s === null || numRows <= 0) {
    return "";
  }
  if (numRows === 1) {
    return s;
  }
  
  let result = "";
  const step = 2 * numRows - 2;
  for (let i = 0; i < numRows; i++) {
    for (let j = i; j < s.length; j += step) {
      result += s[j];
      if (i != 0 && i != numRows - 1 && (j + step - 2 * i) < s.length) {
        result += s[j + step - 2 * i];
      }
    }
  }
  return result;
}',
        ]);

        Solution::create([
            'task_id' => 7,
            'language' => Solution::JS,
            'solution' => "function solution(n){
  let data = String(n);
  
  if(data.length === 1){
    return Number(data);
  }
  
  if(n < 0){
    data = data.substring(1);
  }
  
  let str = data.split('').reverse().join('');
  while(str.charAt(0) === '0'){
    str = str.substring(1);
  }
  
  const newNumber = n < 0 ? Number('-'+str) : Number(str); 
  
  return -2^31 <= newNumber <= 2^31-1 ? newNumber : 0;
}",
        ]);
    }
}
