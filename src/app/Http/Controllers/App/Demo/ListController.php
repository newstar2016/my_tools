<?php

namespace App\Http\Controllers\App\Demo;

use App\Events\PayNotifyEvent;
use App\Http\Controllers\App\BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class ListController extends BaseController
{
    /**
     * @return array
     */
    public function index()
    {
//        try {
//            DB::beginTransaction();
//            event(new PayNotifyEvent(['id'=>1]));
//            DB::commit();
//        } catch (\Exception $e) {
//            Log::error("异常信息：", [
//                'msg'  => $e->getMessage(),
//                'code' => $e->getCode(),
//                'file' => $e->getFile(),
//                'line' => $e->getLine(),
//            ]);
//            DB::rollBack();
//        }
//
//        exit;
//        return success(
//            ['app' => '小程序', 'work' => '企业微信', 'console' => '管理后台']
//        );
        $activity_ids = '1,2,3,1,4';
        $activityIdsBg = array_values(array_filter(explode(',', $activity_ids)));
        var_dump($activityIdsBg);exit;
        //return Response::json(['app' => '小程序', 'work' => '企业微信', 'console' => '管理后台'], 502);
    }
}
