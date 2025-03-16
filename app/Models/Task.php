<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;
    //A Task belongs to a project and includes:
    //Title, description, status
    // ( pending , in_progress , completed ) and due_date
    protected $fillable = [
        'title', 'description', 'status', 'due_date', 'project_id', 'user_id'
    ];
    protected $attributes = [
        'status' => 'pending',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
