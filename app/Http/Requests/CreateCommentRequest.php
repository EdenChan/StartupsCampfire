<?php

namespace StartupsCampfire\Http\Requests;

class CreateCommentRequest extends Request
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
            'body'     => 'required',
        ];
    }

    public function messages()
    {
        return [
            'body.required'     => '评论内容不能为空~',
        ];
    }
}
