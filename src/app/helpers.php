<?php

use App\Exceptions\Error;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

/**
 * 响应成功的结果
 */
if (! function_exists('success')) {
    function success(array $data = [])
    {
        $response = $data;
        Log::debug('Response Success: '.json_encode($response, JSON_UNESCAPED_UNICODE));

        return $response;
    }
}

/**
 * 服务器发生了错误
 */
if (! function_exists('error')) {
    function error($code, $args = [], $statusCode = 500)
    {
        $message = empty(config('code.'.$code)) ? '未知的错误' : config('code.'.$code);

        if (!empty($args)) {
            $message = vsprintf($message, $args);
        }

        throw new Error($code, $message, $statusCode);
    }
}

/**
 * 提示性错误
 */
if (! function_exists('notice')) {
    function notice($code, $args = [], $data = [], $statusCode = 200, $previous = null, $headers = [])
    {
        $message = empty(config('code.'.$code)) ? '未知的错误' : config('code.'.$code);

        if (!empty($args)) {
            $message = vsprintf($message, $args);
        }

        throw new Error($code, $message, $statusCode, $previous, $headers, $data);
    }
}


/**
 * 从redis中获取或存储数据
 *
 * @param      $key
 * @param null $data
 *
 * @return bool
 */
if (!function_exists('getOrSetData')) {
    function getOrSetData($key, $data = null, $expire = 3600)
    {
        if ($data) {
            if ($expire == null) {
                Redis::set($key, json_encode($data));
            } else {
                Redis::setex($key, $expire, json_encode($data));
            }
            return true;
        }

        $res = Redis::get($key);

        if ($res !== null) {
            return json_decode($res, true);
        }
        return false;
    }
}

/**
 * 删除多个redis缓存
 * 传说 redis 对 :  支持好像更好
 */
if (!function_exists('delRedis')) {
    function delRedis($keys)
    {
        if (!is_array($keys) || in_array('*', $keys)) {
            return false;
        }
        $redis = Redis::connection();
        $redis->del($keys);
        return true;
    }
}

/**
 * 统计redis键名管理
 *
 * @param       $keyPrefix string 前缀统一管理在 Common/RedisKey.php
 * @param array ...$args array 可变参数
 *
 * @return string
 */
if (!function_exists('redisKey')) {

    function redisKey($keyPrefix, ...$args)
    {
        $reflection = new ReflectionClass(\App\Common\RedisKey::class);
        $keyPrefix  = $reflection->getConstant($keyPrefix);

        if (empty($keyPrefix)) {
            error('900002');
        }
        $ext = '';

        if (!empty($args)) {

            $result = [];
            array_walk_recursive($args, function ($value, $key) use (&$result) {
                if (!is_numeric($key)) {
                    $value = $key . '_' . $value;
                }
                array_push($result, $value);
            });

            $ext .= implode(':', $result);

        }
        return rtrim(rtrim($keyPrefix, ':') . ':' . $ext, ':');
    }
}