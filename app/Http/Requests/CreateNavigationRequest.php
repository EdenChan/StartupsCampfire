<?php

namespace StartupsCampfire\Http\Requests;

class CreateNavigationRequest extends Request
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
            'name'      => 'required',
            'url'       => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'      => '导航内容不能为空~',
            'url.required'       => '导航链接不能为空~',
        ];
    }
}
