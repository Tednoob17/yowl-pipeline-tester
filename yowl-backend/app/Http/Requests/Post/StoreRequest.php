<?php

namespace App\Http\Requests\Post;

use App\Traits\Requestable;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    use Requestable;

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
            'link' => 'required|url|',
            'panda' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'link.required' => 'The link is necessary to create a panda.',
            'name.url' => 'Please put a real link.',
            'panda.required' => 'The panda is required.',
        ];
    }
}
