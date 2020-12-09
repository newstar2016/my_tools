<?php
/**
 * Created by PhpStorm.
 * User: 龚国新
 * Date: 2020-11-20
 * Time: 10:06
 */

namespace App\Console\Commands;

use App\Common\Constant;
use App\Models\MainMat;
use App\Models\StockMat;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ImportCoupon extends Command
{
    /**
     * @var string
     */
    protected $signature = 'import_coupon';

    /**
     * @var string
     */
    protected $description = '导入优惠券广告数据';

    protected $maxColumnNum = 11; //最大列数

    //广告位id
    protected $locIds = [
        "fb-new"  => 1,
        "fb-test" => 2,
        "fb"      => 1,
        "sqb"     => 2,
        "ls"      => 3,
        "ls-test" => 3,
    ];
    protected $file = "ls.xlsx";
    protected $appid = "wxde69093658ce8aa8";
    protected $mchid = 1530183331;  //代金券商户号
    protected $business_mchid = 1561018721; //商家券商户号

    public function handle()
    {
        $filePath = storage_path('ad-coupon/' . $this->file);
        $objPHPExcel = \PHPExcel_IOFactory::load($filePath);
        $fileNameArr = explode(".", basename($this->file));
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow(); // 总行数

        $import_data = [];
        for ($row = 1; $row <= $highestRow; $row++) {
            $data = [];
            for ($column = 0; $column < $this->maxColumnNum; $column++) {
                $val = $sheet->getCellByColumnAndRow($column, $row)->getValue();
                $val = trim($val);
                if ($column == 7 && $val != "推广时间") {
                    $val = $this->excelTime($val);
                }
                $data[] = $val;
            }

            $import_data[] = $data;
        }

        //插入广告素材和优惠券素材
        array_shift($import_data);
        foreach ($import_data as $key => $item) {
            DB::beginTransaction();
            try {
                if (empty(Constant::PING_PAI[$item[0]])) {
                    dd("品牌不存在");
                    exit;
                }
                $pinpai = Constant::PING_PAI[$item[0]];
                $logo = Constant::PING_LOGO[$item[0]];

                $sn = $fileNameArr[0]."_".$pinpai . $item[1];
                //是否是兜底
                if ($item[8] == "是") {
                    $type = 2;
                    $liangji = "9999999";
                } else {
                    $type = 1;
                    $liangji = rtrim($item[9], "M") . "000";
                }

                //是否是商家券
                if ($item[10] == "是") {
                    $coupon_type = 2;
                    $this->mchid = $this->business_mchid;
                } else {
                    $coupon_type = 1;
                }
                $img_index = $fileNameArr[0]."_".$pinpai.trim($item[2]);

                $main_mat = array(
                    "loc_id"     => $this->locIds[$fileNameArr[0]],
                    "sn"         => $sn,
                    "status"     => 1,
                    "mat_type"   => "single",
                    "main_pic"   => !empty(Constant::NEW_MAIN_PIC[$img_index]) ? Constant::NEW_MAIN_PIC[$img_index] : Constant::MAIN_PIC_DEFAULT,
                    "type"       => $type,
                    "appid"      => $this->appid,
                    "page"       => $item[4],
                    "send_way"   => 1,
                    "filter"     => "{}",
                    "created_at" => time(),
                );
                $main_obj = MainMat::query()->create($main_mat);
                $avilable_bt = strtotime($item[7]);
                $avilable_et = strtotime($item[7]) + 86399;
                if (!empty($item[2])) {
                    $coupon_info = explode("-", $item[2]);
                } else {
                    $coupon_info[0] = 0;
                    $coupon_info[1] = 0;
                }
                if ($item[0] == "南极人内衣") {
                    $item[0] = "南极人";
                }

                $stock_mat = array(
                    "mat_id"              => $main_obj->id,
                    "sn"                  => $sn,
                    "stock_id"            => $item[1],
                    "logo"                => $logo,
                    "type"                => $coupon_type,
                    "name"                => $item[0] . "代金券",
                    "coupon_value"        => floatval(trim($coupon_info[1])) * 100,
                    "transaction_minimum" => floatval(trim($coupon_info[0])) * 100,
                    "mchid"               => $this->mchid,
                    "use_bt"              => 0,
                    "use_et"              => intval(trim($item[5])),
                    "avilable_bt"         => $avilable_bt,//有效开始时间
                    "avilable_et"         => $avilable_et,//有效结束时间
                    "max_quota"           => 5,
                    "limit_send"          => intval($liangji),
                    "weight"              => $key,
                    "created_at"          => time(),
                );
                StockMat::query()->create($stock_mat);
                DB::commit();
            } catch (\Exception $e) {
                Log::info($e);
                DB::rollBack();
            }
        }
    }


    //日期转换
    public function excelTime($date, $time = false)
    {
        //如果是数字则转化，如果是有 - 或者 /，视作文本格式不作处理
        $type1 = strpos($date, '/');
        $type2 = strpos($date, '-');
        if ($type1 || $type2) {
            $return_date = $date;
        } else {
            $return_date = date('Y-m-d', \PHPExcel_Shared_Date::ExcelToPHP($date));
        }

        return $return_date;
    }
}
