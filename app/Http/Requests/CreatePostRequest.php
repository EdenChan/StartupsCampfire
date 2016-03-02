<?php

namespace StartupsCampfire\Http\Requests;

class CreatePostRequest extends Request
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
            'content'     => 'required',
            'category_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'content.required'     => '内容不能为空',
            'category_id.required' => '必须选择动态所属分类',
        ];
    }
}
