<?php
namespace StartupsCampfire\Helpers;

use Illuminate\Support\Facades\Config;

class ViewHelper
{
    /**
     * 返回前端视图
     *
     * @param null $view
     * @param array $data
     * @param array $mergeData
     */
    public static function frontView($view = null, $data = [], $mergeData = [])
    {
        $front_view_path = Config::get('filepath.frontend_view_path');
        $front_view_name = $front_view_path . $view;
        return view($view = $front_view_name, $data = $data, $mergeData = $mergeData);
    }

    /**
     * 返回后台视图
     *
     * @param null $view
     * @param array $data
     * @param array $mergeData
     */
    public static function backView($view = null, $data = [], $mergeData = [])
    {
        $back_view_path = Config::get('filepath.backend_view_path');
        $back_view_name = $back_view_path . $view;
        return view($view = $back_view_name, $data = $data, $mergeData = $mergeData);
    }

}
