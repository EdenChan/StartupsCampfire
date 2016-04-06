<?php

namespace StartupsCampfire\Http\Requests;

class SendEmailToUserRequest extends Request
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
            'form_user_ids'       => 'required',
            'email_title'     => 'required',
            'email_body' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'form_user_ids.required'       => '请选择邮件群发的目标用户',
            'email_title.required'     => '请填写邮件标题',
            'email_body.required' => '请填写邮件正文内容',
        ];
    }
}
