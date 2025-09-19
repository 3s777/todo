<?php

namespace App\Http\Requests\Api\V1;

use App\Enums\StatusEnum;
use App\Exceptions\ValidationException;
use App\Models\Task;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'max:150',
                Rule::unique(Task::class),
            ],
            'status' => [Rule::enum(StatusEnum::class)],
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'Заголовок',
            'status' => 'Статус',
        ];
    }

    public function messages(): array
    {
        return [
            'title' => 'Неверный заголовок',
            'status' => 'Неверный статус',
        ];
    }

    protected function failedValidation(Validator $validator): ValidationException
    {
        throw new ValidationException($validator);
    }
}
