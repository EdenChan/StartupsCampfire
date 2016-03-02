<?php

namespace StartupsCampfire\Http\Controllers\Backend;

use StartupsCampfire\Http\Requests;
use StartupsCampfire\Http\Controllers\Controller;

/**
 * 后台父控制器
 *
 * Class AdminController
 * @package StartupsCampfire\Http\Controllers\Backend
 */
class AdminCommonController extends Controller
{
    public function __construct()
    {
        // 中间件设置
        $this->middleware('admin');
    }
}