<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
            'category_id' => 'required|integer',
            'amount' => 'required|integer|min:0',
            'type' => 'required|in:収入,支出',
            'memo' => 'string|nullable|max:20',
            'date' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'amount.required' =>'金額は必須です',
            'amount.min' => '金額は0以上で入力してください',
            'date.required' => '日付は必須です',
            'memo.max' => 'メモは20文字以下で入力してください',
        ];
    }
}
