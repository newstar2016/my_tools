<?php
/**
 * Created by PhpStorm.
 * User: 龚国新
 * Date: 2019年10月8日
 * Time: 11:48:10
 */

namespace App\Filters\Order;

use App\Filters\Filter;
use Closure;

class UserLoginCheck implements Filter
{
    //检查用户是否登录
    public function handle($content, Closure $next)
    {
        return $next($content);
    }
}