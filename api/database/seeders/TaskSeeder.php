<?php
namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
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
      Task::create([
        'name' => 'Two Sum',
        'badge' => Task::EASY,
        'content' => '<div>Given an array of integers nums and an integer target, return <em>indices of the two numbers such that they add up to target</em>.</div><div>You may assume that each input would have <strong><em>exactly</em></strong><strong> one solution</strong>, and you may not use the <em>same</em> element twice.</div><div>You can return the answer in any order.</div><div><br></div><div><strong>Example 1:</strong></div><pre><strong>Input:</strong> nums = [2,7,11,15], target = 9
<strong>Output:</strong> [0,1]
<strong>Output:</strong> Because nums[0] + nums[1] == 9, we return [0, 1].</pre><div><br><strong>Example 2:</strong></div><pre><strong>Input:</strong> nums = [3,2,4], target = 6
<strong>Output:</strong> [1,2]</pre><div><br><strong>Example 3:</strong></div><pre><strong>Input:</strong> nums = [3,3], target = 6
<strong>Output:</strong> [0,1]</pre><div>&nbsp;</div><div><strong>Constraints:</strong></div><ul><li>2 &lt;= nums.length &lt;= 104</li><li>-109 &lt;= nums[i] &lt;= 109</li><li>-109 &lt;= target &lt;= 109</li><li><strong>Only one valid answer exists.</strong></li></ul><div><br></div><div><strong>Follow-up: </strong>Can you come up with an algorithm that is less than O(n2) time complexity?</div>'
      ]);

      // 2
      Task::create([
        'name' => 'Add Two Numbers',
        'badge' => Task::MEDIUM,
        'content' => '<div>You are given two <strong>non-empty</strong> linked lists representing two non-negative integers. The digits are stored in <strong>reverse order</strong>, and each of their nodes contains a single digit. Add the two numbers and return the sum as a linked list.</div><div>You may assume the two numbers do not contain any leading zero, except the number 0 itself.<br><br></div><div><strong>Example 1:<br></strong><br></div><div><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:342,&quot;url&quot;:&quot;https://assets.leetcode.com/uploads/2020/10/02/addtwonumber1.jpg&quot;,&quot;width&quot;:483}" data-trix-content-type="image" class="attachment attachment--preview"><img src="https://assets.leetcode.com/uploads/2020/10/02/addtwonumber1.jpg" width="483" height="342"><figcaption class="attachment__caption"></figcaption></figure></div><pre><strong>Input:</strong> l1 = [2,4,3], l2 = [5,6,4]
<strong>Output:</strong> [7,0,8]
<strong>Explanation:</strong> 342 + 465 = 807.</pre><div><br><strong>Example 2:</strong></div><pre><strong>Input:</strong> l1 = [0], l2 = [0]
<strong>Output:</strong> [0]</pre><div><br><strong>Example 3:</strong></div><pre><strong>Input:</strong> l1 = [9,9,9,9,9,9,9], l2 = [9,9,9,9]
<strong>Output:</strong> [8,9,9,9,0,0,0,1</pre><div>&nbsp;</div><div><strong>Constraints:</strong></div><ul><li>The number of nodes in each linked list is in the range [1, 100].</li><li>0 &lt;= Node.val &lt;= 9</li><li>It is guaranteed that the list represents a number that does not have leading zeros.</li></ul>'
      ]);

      // 3
      Task::create([
        'name' => 'Longest Substring Without Repeating Characters',
        'badge' => Task::MEDIUM,
        'content' => '<div>Given a string s, find the length of the <strong>longest substring</strong> without repeating characters.<br><br></div><div><strong>Example&nbsp;</strong></div><pre><strong>Input:</strong> s = "abcabcbb"
<strong>Output:</strong> 3
<strong>Explanation:</strong> The answer is "abc", with the length of 3</pre><div><br><strong>Example 2:</strong></div><pre><strong>Input:</strong> s = "bbbbb"
<strong>Output:</strong> 1
<strong>Explanation:</strong> The answer is "b", with the length of 1.</pre><div><br><strong>Example 3:</strong></div><pre><strong>Input:</strong> s = "pwwkew"
<strong>Output:</strong> 3
<strong>Explanation:</strong> The answer is "wke", with the length of 3.
Notice that the answer must be a substring, "pwke" is a subsequence and not a substring.</pre><div><br><strong>Example 4:</strong></div><pre><strong>Input:</strong> s = ""
<strong>Output:</strong> 0</pre><div>&nbsp;</div><div><strong>Constraints:</strong></div><ul><li>0 &lt;= s.length &lt;= 5 * 104</li><li>s consists of English letters, digits, symbols and spaces.</li></ul>'
      ]);

      // 4
      Task::create([
        'name' => 'Median of Two Sorted Arrays',
        'badge' => Task::HARD,
        'content' => '<div>Given two sorted arrays nums1 and nums2 of size m and n respectively, return <strong>the median</strong> of the two sorted arrays.</div><div>The overall run time complexity should be O(log (m+n)).</div><div><strong>Example 1:<br></strong><br></div><pre><strong>Input:</strong> nums1 = [1,3], nums2 = [2]
<strong>Output:</strong> 2.00000
<strong>Explanation:</strong> merged array = [1,2,3] and median is 2.</pre><div><br><strong>Example 2:</strong></div><pre><strong>Input:</strong> nums1 = [1,2], nums2 = [3,4]
<strong>Output:</strong> 2.50000
<strong>Explanation:</strong> merged array = [1,2,3,4] and median is (2 + 3) / 2 = 2.5.</pre><div><strong>Example 3:<br></strong><br></div><pre><strong>Input:</strong> nums1 = [0,0], nums2 = [0,0]
<strong>Output:</strong> 0.00000</pre><div><br><strong>Example 4:</strong></div><pre><strong>Input:</strong> nums1 = [], nums2 = [1]
<strong>Output:</strong> 1.00000</pre><div><br><strong>Example 5:</strong></div><pre><strong>Input:</strong> nums1 = [2], nums2 = []
<strong>Output:</strong> 2.00000</pre><div><br></div><div><strong>Constraints:</strong></div><ul><li>nums1.length == m</li><li>nums2.length == n</li><li>0 &lt;= m &lt;= 1000</li><li>0 &lt;= n &lt;= 1000</li><li>1 &lt;= m + n &lt;= 2000</li><li>-106 &lt;= nums1[i], nums2[i] &lt;= 106</li></ul>'
      ]);

      // 5
      Task::create([
        'name' => 'Longest Palindromic Substring',
        'badge' => Task::MEDIUM,
        'content' => '<div>Given a string s, return <em>the longest palindromic substring</em> in s.<br><br></div><div><strong>Example 1:</strong></div><pre><strong>Input:</strong> s = "babad"
<strong>Output:</strong> "bab"
<strong>Note:</strong> "aba" is also a valid answer.</pre><div><br><strong>Example 2:</strong></div><pre><strong>Input:</strong> s = "cbbd"
<strong>Output:</strong> "bb"</pre><div><strong>Example 3:<br></strong><br></div><pre><strong>Input:</strong> s = "a"
<strong>Output:</strong> "a"</pre><div><br><strong>Example 4:</strong></div><pre><strong>Input:</strong> s = "ac"
<strong>Output:</strong> "a"</pre><div><br></div><div><strong>Constraints:</strong></div><ul><li>1 &lt;= s.length &lt;= 1000</li><li>s consist of only digits and English letters.</li></ul>'
      ]);

      // 6
      Task::create([
        'name' => 'Zigzag Conversion',
        'badge' => Task::MEDIUM,
        'content' => '<div>The string "PAYPALISHIRING" is written in a zigzag pattern on a given number of rows like this: (you may want to display this pattern in a fixed font for better legibility)</div><pre>P   A   H   N
A P L S I I G
Y   I   R</pre><div>And then read line by line: "PAHNAPLSIIGYIR"</div><div>Write the code that will take a string and make this conversion given a number of rows:</div><pre>string convert(string s, int numRows);</pre><div>&nbsp;</div><div><strong>Example 1:</strong></div><pre><strong>Input:</strong> s = "PAYPALISHIRING", numRows = 3
<strong>Output:</strong> "PAHNAPLSIIGYIR</pre><div><br><strong>Example 2:</strong></div><pre><strong>Input:</strong> s = "PAYPALISHIRING", numRows = 4
<strong>Output:</strong> "PINALSIGYAHRPI"
<strong>Explanation:</strong>
P     I    N
A   L S  I G
Y A   H R
P     I</pre><div><strong>Example 3:</strong></div><pre><strong>Input:</strong> s = "A", numRows = 1
<strong>Output:</strong> "A"</pre><div>&nbsp;</div><div><strong>Constraints:</strong></div><ul><li>1 &lt;= s.length &lt;= 1000</li><li>s consists of English letters (lower-case and upper-case), \',\' and \'.\'.</li><li>1 &lt;= numRows &lt;= 1000</li></ul>'
      ]);

      // 7
      Task::create([
        'name' => 'Reverse Integer',
        'badge' => Task::MEDIUM,
        'content' => '<div>Given a signed 32-bit integer x, return x<em> with its digits reversed</em>. If reversing x causes the value to go outside the signed 32-bit integer range [-231, 231 - 1], then return 0.</div><div><strong>Assume the environment does not allow you to store 64-bit integers (signed or unsigned).<br></strong><br></div><div><strong>Example 1:</strong></div><pre><strong>Input:</strong> x = 123
<strong>Output:</strong> 321</pre><div><br><strong>Example 2:</strong></div><pre><strong>Input:</strong> x = -123
<strong>Output:</strong> -321</pre><div><br><strong>Example 3:</strong></div><pre><strong>Input:</strong> x = 120
<strong>Output:</strong> 21</pre><div><br><strong>Example 4:</strong></div><pre><strong>Input:</strong> x = 0
<strong>Output:</strong> 0</pre><div><br><strong>Constraints:</strong></div><ul><li>-2^31 &lt;= x &lt;= 2^31 - 1</li></ul>'
      ]);

    }
}
