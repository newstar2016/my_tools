<?php

namespace App\Console;

use App\Console\Commands\Document;
use App\Console\Commands\ImportCoupon;
use App\Console\Commands\ImportOldCoupon;
use App\Console\Commands\MigrateData;
use App\Console\Commands\Statistics;
use App\Console\Commands\StatisticsCoupon;
use App\Console\Commands\TestAes;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // api document
        'doc'               => Document::class,

        // swoole
        'swoole:client'     => Commands\Swoole\Client::class,
        'swoole:server'     => Commands\Swoole\Server::class,
        'import_coupon'     => ImportCoupon::class,
        'import_old_coupon' => ImportOldCoupon::class,
        'test_aes'          => TestAes::class,
        'migrate_data'      => MigrateData::class,
        'statistics'        => Statistics::class,
        'statistics_coupon' => StatisticsCoupon::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //
    }
}
