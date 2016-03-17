<?php

namespace StartupsCampfire\Http\Requests;

class CreateCategoryRequest extends Request
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
            'content'   => 'required',
        ];
    }

    public function messages()
    {
        return [
            'content.required'   => '分类名称不能为空~',
        ];
    }
}
