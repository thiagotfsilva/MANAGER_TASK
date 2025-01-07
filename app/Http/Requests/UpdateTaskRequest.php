<?php

namespace App\Http\Requests;

use App\Enum\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
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
            'title' => 'sometimes|min:5|max:256',
            'description' => 'sometimes|min:5',
            'status' => [
                'sometimes',
                'string',
                Rule::in([
                    TaskStatus::PENDING->name,
                    TaskStatus::IN_PROGRESS->name,
                    TaskStatus::DONE->name,
                ]),
            ],
            'completed_at' => [
                'sometimes',
                'date',
                Rule::requiredIf($this->input('status') === TaskStatus::DONE->name),
            ],
        ];
    }

    /**
     * Custom messages for validation errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'O título é obrigatório.',
            'title.min' => 'O título deve ter no mínimo 5 caracteres.',
            'title.max' => 'O título deve ter no máximo 256 caracteres.',
            'status.required' => 'O status é obrigatório.',
            'status.in' => 'O status deve ser PENDING, IN_PROGRESS ou DONE.',
            'completed_at.date' => 'O campo completed_at deve ser uma data válida.',
            'completed_at.required_if' => 'O campo completed_at é obrigatório quando o status for DONE.',
        ];
    }
}
