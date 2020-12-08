<?php
/**
 * Created by PhpStorm.
 * User: simple
 * Date: 2018/11/9
 * Time: 10:00 AM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * 首页
     *
     * 仅在开发环境才会输入日志
     *
     * @param Request $request
     * @return array|mixed
     * @author   陈朔  chenshuo@vchangyi.com
     * @date     2018/12/7 10:48 AM
     */
    public function index(Request $request)
    {
        $env = config('app.env');

        // 如果是开发环境才输出日志
        if ($env === 'dev') {

            $file = empty($request->get('file')) ? date('Y/m/d/\h-H', time()).'.log' : $request->get('file');
            $file = storage_path('logs/'.$file);

            if (!file_exists($file)) {
                return notice(100007);
            }

            $data = file_get_contents($file);
            return view('logging')
                ->with('file', $file)
                ->with('data', $data);
        }

        return 'shop.'.$env;
    }
}
