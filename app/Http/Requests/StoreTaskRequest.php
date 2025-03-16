<?php

namespace App\Http\Requests;
use App\Models\Project;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;
class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'status' => 'nullable|in:pending,in_progress,completed',
            'due_date' => 'required|date|date_format:Y-m-d H:i:s',
            //'project_id' => 'required|exists:projects,id',
        ];
    }
}
