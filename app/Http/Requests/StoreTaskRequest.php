<?php

namespace App\Http\Requests;

use App\Enum\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:5|max:256',
            'description' => 'nullable|min:5',
            // 'status' => 'required|string|in:' . TaskStatus::PENDING->name . ',' . TaskStatus::IN_PROGRESS->name . ',' . TaskStatus::DONE->name,
        ];
    }
}
