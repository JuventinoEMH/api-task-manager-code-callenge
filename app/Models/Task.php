<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;
    //A Task belongs to a project and includes:
    //Title, description, status
    // ( pending , in_progress , completed ) and due_date
    protected $fillable = [
        'title', 'description', 'status', 'due_date'
    ];
    protected $attributes = [
        'status' => 'pending',
    ];
}
