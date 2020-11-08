<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'username' => 'required|string|max:12|min:4',
            'mail' => 'required|string|email|max:12|min:4|unique:users',
            'password' => 'required|string|unique:users|min:4|max:12|regex:/^[a-zA-Z0-9]+$/|confirmed',
        ];
    }

    public function attributes()
    {
      return [
        'username' => 'ユーザー名',
        'mail' => 'メールアドレス',
        'password' => 'パスワード',
      ];
    }

    public function messages() {
      return [
        'username.required' => 'ユーザー名を入力してください。',
        'username.min' => 'ユーザー名は4文字以上です。',
        'mail.email' => 'メールアドレスとして正しい形式ではありません。',
        'mail.unique' => 'このメールアドレスはすでに使用されています。',
        'password.min' => 'パスワードは4文字以上です。',
        'password.unique' => 'このパスワードはすでに使用されています。',
        'password.regex' => 'パスワードは半角英数字で入力してください。',
      ];
    }
}
