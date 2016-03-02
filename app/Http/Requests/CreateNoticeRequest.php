<?php

namespace StartupsCampfire\Http\Requests;

class CreateNoticeRequest extends Request
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
            'title'   => 'required',
            'content' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required'   => '公告标题不能为空~',
            'content.required' => '公告内容不能为空~',
        ];
    }
}
