<?php

namespace StartupsCampfire\Http\Requests;

class CreateEventRequest extends Request
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
            'title'      => 'required',
            'brief'      => 'required|max:50',
            'start_date' => 'required',
            'end_date'   => 'required',
            'location'   => 'required',
            'cover'      => 'required',
            'content'    => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required'      => '活动标题不能为空~',
            'brief.required'      => '活动简介不能为空~',
            'brief.max'           => '活动简介不能超过50字~',
            'start_date.required' => '活动开始日期不能为空~',
            'end_date.required'   => '活动结束日期不能为空~',
            'location.required'   => '活动举办地点不能为空~',
            'cover.required'      => '活动封面图不能为空~',
            'content.required'    => '活动内容描述不能为空~',
        ];
    }
}
