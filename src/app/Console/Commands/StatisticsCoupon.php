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

class StatisticsCoupon extends Command
{
    /**
     * @var string
     */
    protected $signature = 'statistics_coupon';

    /**
     * @var string
     */
    protected $description = '统计一天内的发券数';

    protected $waitDealFilePrefix = "coupon_count";
    protected $selectDate = "2020-12-16";

    public function handle()
    {
        for ($i = 0; $i < 24; $i++) {
            $start = strtotime(date($this->selectDate) . ' +'.$i.' hour');
            $end = strtotime(date($this->selectDate) . ' +'.($i+1).' hour');
//            echo $start."-".$end.PHP_EOL;
            $count = DB::table("ad_send_log")->where('created_at', '>', $start)->where('created_at', '<', $end)->count();
            file_put_contents(storage_path('request-logs/' . $this->waitDealFilePrefix . $this->selectDate . ".txt"), "时间段：" . date("Y-m-d H:i:s",$start) . "-" . date("Y-m-d H:i:s",$end) . ",发券数:" . $count.PHP_EOL);
        }
    }
}
