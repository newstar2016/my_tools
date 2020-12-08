<?php
/**
 * Created by PhpStorm.
 * Function: xxx
 * User: 龚国新
 * Date: 2019/9/25
 * Time: 10:34
 */

namespace App\Http\Middleware;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;

class TestGuzzleRetry
{
    /**
     * 最大重试次数
     */
    const MAX_RETRIES = 5;

    /**
     * @var Client
     */
    protected $client;

    /**
     * GuzzleRetry constructor.
     */
    public function __construct()
    {
        // 创建 Handler
        $handlerStack = HandlerStack::create(new CurlHandler());
        // 创建重试中间件，指定决策者为 $this->retryDecider(),指定重试延迟为 $this->retryDelay()
        $handlerStack->push(Middleware::retry($this->retryDecider(), $this->retryDelay()));
        // 指定 handler
        $this->client = new Client(['handler' => $handlerStack]);
    }
    /**
     * retryDecider
     * 返回一个匿名函数, 匿名函数若返回false 表示不重试，反之则表示继续重试
     * @return Closure
     */
    protected function retryDecider()
    {
        return function (
            $retries,
            Request $request,
            Response $response = null,
            RequestException $exception = null
        ) {
            // 超过最大重试次数，不再重试
            if ($retries >= self::MAX_RETRIES) {
                return false;
            }

            // 请求失败，继续重试
            if ($exception instanceof ConnectException) {
                return true;
            }

            if ($response) {
                // 如果请求有响应，但是状态码大于等于500，继续重试(这里根据自己的业务而定)
                if ($response->getStatusCode() >= 500) {
                    return true;
                }
            }

            return false;
        };
    }

    /**
     * 返回一个匿名函数，该匿名函数返回下次重试的时间（毫秒）
     * @return Closure
     */
    protected function retryDelay()
    {
        return function ($numberOfRetries) {
            return 1000 * $numberOfRetries;
        };
    }
}