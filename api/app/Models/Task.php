<?php

namespace App\Models;

use App\Models\Solution;
use App\Models\TaskContent;
use App\Models\TaskTest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'badge',
        'content'
    ];

    // task badge type
    const EASY = 'Easy';
    const MEDIUM = 'Medium';
    const HARD = 'Hard';

    public function solution()
    {
        return $this->hasMany(Solution::class);
    }

    public function tests()
    {
        return $this->hasMany(TaskTest::class);
    }
}
