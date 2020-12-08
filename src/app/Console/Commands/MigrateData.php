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

class MigrateData extends Command
{
    /**
     * @var string
     */
    protected $signature = 'migrate_data';

    /**
     * @var string
     */
    protected $description = '跨库迁移脚本';

    protected $fromDatabase = ''; //数据来源数据库
    protected $toDatabase = ''; //数据迁移目表数据库
    protected $key = "TZg48UDNGGfhbHiEcvVqNPRtTOSGzKcT";

    public function handle()
    {
        $this->fromDatabase = DB::connection('mysql_old');
        $this->toDatabase = DB::connection('mysql_new');
        $key = "hwj_stock_callbacks";
        $this->fromDatabase->table($key)
            ->where("summary","商家券领券通知")
            ->orderBy('create_time', 'desc')
            ->chunk(100, function ($oldData) use ($key) {
                foreach ($oldData as $old) {
                    $D=json_decode($old->resource,true);
                    if($D=self::AesDeCode($D["ciphertext"],$D["nonce"],$D["associated_data"])){

                    }else{
                        echo "解密错误";
                        continue;
                    }

                    if(!in_array($D['stock_id'],['1284420000000080'])){
                        continue;
                    }
                    $D['id'] = $old->id;
                    $D['created_at']=$old->create_time;
                    $old->create_time_str = $D['send_time'];
                    try {
                        $this->toCallbackLog("ad_callback_log", (array)$old);
                        $this->toCallbackPlaintext("ad_callback_plaintext", $D);
                    } catch (\Exception $exception) {
                        Log::info('迁移数据错误,数据id：' . $old->id . ',错误信息：' . $exception->getMessage());
                    }
                }
            });
    }

    public function toCallbackPlaintext($table, $old)
    {
        $insertData = [
            'callback_id'   => $old['id'],
            'event_type'    => $old['event_type'],
            'coupon_code'   => $old['coupon_code'],
            'stock_id'      => $old['stock_id'],
            'send_time'     => $old['send_time'],
            'openid'        => $old['openid'],
            'unionid'       => $old['unionid'],
            'send_channel'  => $old['send_channel'],
            'send_merchant' => $old['send_merchant'],
            'attach_info'   => $old['attach_info'],
            'send_req_no'   => $old['send_req_no'],
            'created_at'    => $old['created_at']
        ];


        $this->toDatabase->table($table)->insert($insertData);
    }

    public function toCallbackLog($table, $old)
    {

        $insertData = [
            'id'            => $old['id'],
            'create_time'   => $old['create_time_str'],
            'event_type'    => $old['event_type'],
            'resource_type' => $old['resource_type'],
            'summary'       => $old['summary'],
            'resource'      => $old['resource'],
            'created_at'    => $old['create_time'],
        ];
        $this->toDatabase->table($table)->insert($insertData);
    }


    /**
     * @notes SHA256签名AEAD_AES_256_GCM解密
     * @param $ciphertext
     * @param $nonce
     * @param string $associated_data
     * @return mixed|array
     */
    public function AesDeCode($ciphertext, $nonce, $associated_data = 'certificate')
    {
        $check_sodium_mod = extension_loaded('sodium');
        if ($check_sodium_mod === false) {
            echo '没有安装sodium模块';
            die;
        }
        $check_aes256gcm = sodium_crypto_aead_aes256gcm_is_available();
        if ($check_aes256gcm === false) {
            echo '当前不支持aes256gcm';
            die;
        }
        if ($pem = sodium_crypto_aead_aes256gcm_decrypt(base64_decode($ciphertext), $associated_data, $nonce, $this->key)) {
            return json_decode($pem, 1);
        } else {
            return $pem;
        }
    }
}
