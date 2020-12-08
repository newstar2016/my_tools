<?php
/**
 * 从文件中提取已支付的订单号
 */
namespace App\Http\Controllers\App\Demo;

use App\Http\Controllers\App\BaseController;
use Illuminate\Support\Facades\Redis;

class ScreeningPayBackOrderNumberController extends BaseController
{
    public $import_dir_path = 'D:/FileOperate/import'; //导入文件的文件夹路径

    public $export_files_path = 'D:\FileOperate\export\export_order.txt'; //筛选订单号写入的文件路径

    public $append_files_path = 'D:\FileOperate\export\append_order.txt'; //需要补单的路径

    public $flag = false; //true 写入补单文件里，false 写入筛选文件里

    //需要筛选的订单号
    public $append_order = [
        '11920186696649'
    ];

    public $file_path = []; //存文件夹下所有文件的路径

    public $temp_order = '';

    /**
     * 批量从文件中筛选订单号
     *
     * @return array
     */
    public function index()
    {
        $redis      = Redis::connection();
        $start_time = time();
        ini_set('memory_limit', '3072M');    // 临时设置最大内存占用为3G
        set_time_limit(0);   // 设置脚本最大执行时间 为0 永不过期
        if ($this->flag) {
            $fp = fopen($this->append_files_path, 'a') or die("can't open $this->append_files_path for write");
        } else {
            $fp = fopen($this->export_files_path, 'a') or die("can't open $this->export_files_path for write");
        }

        //从某个文件夹下批量读取文件
        $this->read_all($this->import_dir_path);

        foreach ($this->file_path as $value) {
            $file_path = $this->readTheFile($value);
            foreach ($file_path as $line_value) {

                $line_arr = json_decode($line_value, TRUE);
                if ($line_arr['message'] != 'WeChat callback came in') {
                    continue;
                }
                if (!empty($line_arr['context']['out_trade_no'])) {
                    if ($this->flag) {
                        if (in_array($line_arr['context']['out_trade_no'], $this->append_order)) {
                            $line_str = $line_arr['context']['out_trade_no'] . '===' . json_encode($line_arr['context']) . PHP_EOL;
                            $this->writeIntoFile($fp, $line_str);
                        }
                    } else {
                        $line_str = $line_arr['context']['out_trade_no'] . ',' . PHP_EOL;
                        //将文件中的订单号写入到文件中
                        if (!empty($line_str)) {
                            $this->writeIntoFile($fp, $line_str);
                        }
                    }

                }
            }
        }
        fclose($fp);
        $end_time = time();
        echo "提取完成，总耗时:" . ($end_time - $start_time) . '秒';
    }

    /**
     * 读取文件的内容
     *
     * @param $path
     *
     * @return \Generator
     */
    public function readTheFile($path)
    {
        $handle = fopen($path, "r");
        while (!feof($handle)) {
            yield trim(fgets($handle));
        }
        fclose($handle);
    }

    /**
     * 将读取的内容写入到文件中
     *
     * @param $fp
     * @param $str
     */
    public function writeIntoFile($fp, $str)
    {
        fwrite($fp, $str);
    }

    /**
     * 遍历文件夹下的所有文件
     *
     * @param $dir
     */
    public function read_all($dir)
    {
        //检测是否存在文件

        if (is_dir($dir)) {

            //打开目录

            if ($handle = opendir($dir)) {

                //返回当前文件的条目

                while (($file = readdir($handle)) !== false) {

                    //去除特殊目录

                    if ($file != "." && $file != "..") {

                        //判断子目录是否还存在子目录

                        if (is_dir($dir . "/" . $file)) {

                            //递归调用本函数，再次获取目录

                            $this->read_all($dir . "/" . $file);

                        } else {
                            //获取目录数组
                            $this->file_path[] = $dir . "/" . $file;

                        }

                    }

                }

                //关闭文件夹

                closedir($handle);
            }

        }
    }
}
