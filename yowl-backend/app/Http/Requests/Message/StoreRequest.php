<?php

namespace App\Http\Requests\Message;

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
            'user_id' => ['required', 'integer'],
            'room_id' => ['required', 'integer'],
            'content' => ['required', 'string']
        ];
    }
}
