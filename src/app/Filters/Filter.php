<?php
/**
 * Created by PhpStorm.
 * User: 龚国新
 * Date: 2019年10月8日
 * Time: 11:48:10
 */

namespace App\Filters;

use Closure;

interface Filter
{
    public function handle($content, Closure $next);
}