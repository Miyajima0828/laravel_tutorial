<?php

namespace App\Http\Requests;

use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditTask extends FormRequest
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
    public function rules()
    {
        return [
            'status' => [
                'required',
                Rule::in(array_keys(Task::STATUS))
                ]
        ];
    }

    public function attributes()
    {
        $attributes = parent::attributes();

        return $attributes + [
            'status' => '状態',
        ];
    }

    public function messages()
    {
        $messages = parent::messages();

        $status_labels = array_map(function($item) {
            return $item['label'];
        }, Task::STATUS);

        $status_labels = implode('、', $status_labels);

        return $messages + [
            'status.in' => ':attribute には ' . $status_labels. ' のいずれかを指定してください。',
        ];
    }
}
