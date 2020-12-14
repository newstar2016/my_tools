<?php
/**
 * 从日志文件中解析统计日志
 *
 * Created by PhpStorm.
 * User: 龚国新
 * Date: 2020-11-20
 * Time: 10:06
 */

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Statistics extends Command
{
    /**
     * @var string
     */
    protected $signature = 'statistics';

    /**
     * @var string
     */
    protected $description = '从日志中统计数据';

    protected $loc_name = 'sqb_loc';

    protected $filesPath = [
//        "hwj-adserver-req-VM_8_187_centos.20201210.log",
//        "hwj-adserver-req-VM_8_187_centos.20201211.log",
        "hwj-adserver-req-VM_8_187_centos.20201212.log",
        "hwj-adserver-req-VM_8_187_centos.20201213.log"
    ];

    protected $selectDate = "2020-12-13";

    protected $statisticsInfo = [];

    protected $waitDealFilePrefix = "wait_deal";

    public function handle()
    {
        foreach ($this->filesPath as $fileName){
            $this->statisticsInfo[$fileName]['select-date']= $this->selectDate;
            $this->statisticsInfo[$fileName]['pay_ad/ad_coupon'] = 0;
            $this->statisticsInfo[$fileName]['pay_ad/ad_coupon/error'] = 0;
            $filePath = storage_path('request-logs/' . $fileName);
            $file = fopen($filePath, "r") or exit("Unable to open file!");
            while (!feof($file)) {
                $line = fgets($file);
                $decode = json_decode($line, true);
                $this->statisticsInfo[$fileName]['pay_ad/ad_coupon']+=$this->StatisticsBaoGuang($decode);
                $this->statisticsInfo[$fileName]['pay_ad/ad_coupon/error']+=$this->StatisticsBaoGuangErr($decode);
            }
            fclose($file);
        }

        dd($this->statisticsInfo);
        die;
    }

    //检查匹配符合要求的项,曝光接口
    public function StatisticsBaoGuang($lineInfo)
    {
        $is_match = 0;
        $startTime = strtotime($this->selectDate);
        $endTime = strtotime($this->selectDate."+1 day");

        if ($lineInfo['path'] == "/pay_ad/ad_coupon" && $lineInfo['req']['loc_name'] == $this->loc_name && $lineInfo['ts']>=$startTime && $lineInfo['ts']<$endTime) {
            $is_match = 1;
        }
        return $is_match;
    }

    //检查匹配符合要求的项,曝光接口,错误
    public function StatisticsBaoGuangErr($lineInfo)
    {
        $is_match = 0;
        $startTime = strtotime($this->selectDate);
        $endTime = strtotime($this->selectDate."+1 day");

        if ($lineInfo['path'] == "/pay_ad/ad_coupon" && $lineInfo['req']['loc_name'] == $this->loc_name && $lineInfo['ts']>=$startTime && $lineInfo['ts']<$endTime) {
            if(!empty($lineInfo['resp']['message']) && $lineInfo['resp']['message']=="ERROR!"){
                file_put_contents(storage_path('request-logs/' . $this->waitDealFilePrefix.$this->selectDate.".txt"),"返回错误的用户:".$lineInfo['req']['openid'].PHP_EOL,FILE_APPEND);
                $is_match = 1;
            }
        }
        return $is_match;
    }

    //检查匹配符合要求的项,领券通知接口
    public function StatisticsCoupon($lineInfo)
    {
        $is_match = 0;
        $startTime = strtotime($this->selectDate);
        $endTime = strtotime($this->selectDate."+1 day");
        if ($lineInfo['path'] == "/pay_ad/ad_ping" && $lineInfo['req']['loc_name'] == $this->loc_name && $lineInfo['ts']>=$startTime && $lineInfo['ts']<$endTime) {
            $is_match = 1;
        }
        return $is_match;
    }


    //检查匹配符合要求的项,曝光接口,错误
    public function StatisticsCouponErr($lineInfo)
    {
        $is_match = 0;
        $startTime = strtotime($this->selectDate);
        $endTime = strtotime($this->selectDate."+1 day");

        if ($lineInfo['path'] == "/pay_ad/ad_ping" && $lineInfo['req']['loc_name'] == $this->loc_name && $lineInfo['ts']>=$startTime && $lineInfo['ts']<$endTime && $lineInfo['resp']['message']=="ERROR!") {
            $is_match = 1;
        }
        return $is_match;
    }
}
