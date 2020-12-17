<?php
/**
 * Created by PhpStorm.
 * User: 龚国新
 * Date: 2020-11-20
 * Time: 10:06
 */

namespace App\Console\Commands;

use App\Common\Constant;
use App\Models\Material;
use App\Models\MaterialLoc;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ImportOldCoupon extends Command
{
    /**
     * @var string
     */
    protected $signature = 'import_old_coupon';

    /**
     * @var string
     */
    protected $description = '导入优惠券旧广告数据';

    protected $maxColumnNum = 10; //最大列数

    //广告位id
    protected $locIds = [
        "fb"  => 1,
        "sqb" => 2,
    ];

    protected $file = "sqb.xlsx";

    protected $appid = "wxde69093658ce8aa8";
    protected $mchid = 1530183331;

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
                $sn = $fileNameArr[0]."_".$pinpai . $item[1];
                //是否是兜底
                if ($item[8] == "是") {
                    $type = 2;
                    $liangji = "9999999";
                } else {
                    $type = 1;
                    $liangji = rtrim($item[9], "M") . "000";
                }

                $avilable_bt = strtotime($item[7]);
                $avilable_et = strtotime($item[7]) + 86399;

                $send_way = 1;
                if ($item[0] == "活动页") {
                    $send_way = 3;
                }
                $img_index = $fileNameArr[0]."_".$pinpai.trim($item[2]);

                $main_mat = array(
                    "sn"          => $sn,
                    "type"        => $type,
                    "img_url"     => !empty(Constant::NEW_MAIN_PIC[$img_index]) ? Constant::NEW_MAIN_PIC[$img_index] : Constant::MAIN_PIC_DEFAULT,
                    "stock_id"    => trim($item[1]),
                    "mchid"       => $this->mchid,
                    "use_et"      => intval(trim($item[5])),
                    "avilable_bt" => $avilable_bt,
                    "avilable_et" => $avilable_et,
                    "appid"       => $this->appid,
                    "page"        => trim($item[4]),
                    "filter"      => "{}",
                    "limit_send"  => $liangji,
                    "send_way"    => $send_way,
                    "weight"      => $key,
                    "created_at"  => time(),
                );

                $mat_obj = Material::query()->create($main_mat);
                if($this->locIds[$fileNameArr[0]]==1){
                    $mat_obj->update(['stock_id'=>(trim($item[1])+$mat_obj->id)]);
                }

                $mat_loc = array(
                    "mat_id" => $mat_obj->id,
                    "loc_id" => $this->locIds[$fileNameArr[0]]
                );
                MaterialLoc::query()->create($mat_loc);

                DB::commit();
                Log::info("今日插入广告素材:" . $mat_obj->id);
                echo "已处理到第" . $key . "个,批次号：" . $item[1] . ",广告素材id：" . $mat_obj->id . PHP_EOL;
            } catch (\Exception $e) {
                Log::error($e);
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
