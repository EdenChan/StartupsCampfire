<?php
namespace StartupsCampfire\Helpers;

/**
 * 文件辅助类
 *
 * Class FileHelper
 * @package StartupsCampfire\Helpers
 */
class FileHelper
{
    /**
     * 上传文件
     *
     * @param array $files_info 文件信息 格式为(['文件名' => '文件路径'])的数组
     * @param array $input
     * @return array 返回更新文件名字段后的Input数据
     */
    public static function uploadFiles($files_info = [], &$input = [])
    {
        $request = app('Request');
        if (!empty($files_info)) {
            foreach ($files_info as $file_name => $file_path) {
                if ($request::hasFile($file_name)) {
                    $upload_file = $request::file($file_name);
                    $upload_ext = $upload_file->getClientOriginalExtension();
                    $upload_name = $file_name . time() . '.' . $upload_ext;
                    $upload_file->move($file_path, $upload_name);
                    $input[$file_name] = $upload_name;
                }
            }
        }
        return $input;
    }

    /**
     * 删除文件
     *
     * @param array $files_info
     */
    public static function deleteFiles($files_info = [])
    {
        $file_system = app('File');
        if (!empty($files_info)) {
            foreach ($files_info as $file_name => $file_path) {
                $full_file_name = $file_path . $file_name;
                $file_system::delete($full_file_name);
            }
        }
    }

    /**
     * 替换文件 删除旧文件 上传新文件 更新Input数据
     *
     * @param $new_files_info
     * @param $old_files_info
     * @param array $input
     */
    public static function replaceFiles($new_files_info = [], $old_files_info = [], &$input = [])
    {
        $request = app('Request');
        if (!empty($new_files_info)) {
            foreach ($new_files_info as $file_name => $file_path) {
                if (!($request::hasFile($file_name))) {
                    unset($new_files_info[$file_name]);
                    unset($old_files_info[$file_name]);
                }
            }
            if (!empty($new_files_info) && !empty($old_files_info)) {
                self::deleteFiles($old_files_info);
                return self::uploadFiles($new_files_info, $input);
            } else {
                return $input;
            }
        } else {
            return $input;
        }
    }

}