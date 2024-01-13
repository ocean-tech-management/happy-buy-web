<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Laravel\Telescope\Console\PruneCommand;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        PruneCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        $schedule->call('App\Http\Controllers\Admin\PointBalanceController@balance')->dailyAt('00:05')->name('settlement_point_millionaire_balance')->withoutOverlapping();
        $schedule->call('App\Http\Controllers\Admin\PointManagerBalanceController@balance')->dailyAt('00:06')->name('settlement_point_manager_balance')->withoutOverlapping();
        $schedule->call('App\Http\Controllers\Admin\PointExecutiveBalanceController@balance')->dailyAt('00:07')->name('settlement_point_executive_balance')->withoutOverlapping();
        $schedule->call('App\Http\Controllers\Admin\PointBonusBalanceController@balance')->dailyAt('00:08')->name('settlement_point_bonus_balance')->withoutOverlapping();
        $schedule->call('App\Http\Controllers\Admin\VoucherBalanceController@balance')->dailyAt('00:09')->name('settlement_voucher_balance')->withoutOverlapping();
        $schedule->call('App\Http\Controllers\Admin\ShippingBalanceController@balance')->dailyAt('00:10')->name('settlement_shipping_balance')->withoutOverlapping();
        $schedule->call('App\Http\Controllers\Admin\CashVoucherBalanceController@balance')->dailyAt('00:11')->name('settlement_cash_voucher_balance')->withoutOverlapping();
        $schedule->call('App\Http\Controllers\Admin\PvBalanceController@balance')->dailyAt('00:12')->name('settlement_pv_balance')->withoutOverlapping();
        $schedule->call('App\Http\Controllers\Admin\VoucherLogController@balance')->dailyAt('00:13')->name('settlement_voucher_log')->withoutOverlapping();

        // Update Report Stock and Shipping Credit
        $schedule->call('App\Http\Controllers\Admin\ReportSummaryController@stockCreditRearrangeRecord')->dailyAt('01:10')->name('daily_report_stock_credit')->withoutOverlapping();
        $schedule->call('App\Http\Controllers\Admin\ReportSummaryController@shippingCreditRearrangeRecord')->dailyAt('01:11')->name('daily_report_shipping_credit')->withoutOverlapping();
        $schedule->call('App\Http\Controllers\Admin\ReportSummaryController@bonusCreditRearrangeRecord')->dailyAt('01:12')->name('daily_report_bonus_credit')->withoutOverlapping();
        $schedule->call('App\Http\Controllers\Admin\ReportSummaryController@voucherCreditRearrangeRecord')->dailyAt('01:13')->name('daily_report_voucher_credit')->withoutOverlapping();

        //give monthly personal topup bonus
        $schedule->call('App\Http\Controllers\Admin\TransactionPointPurchaseController@calculatePersonalTopUpBonus')->monthlyOn(1, '00:10')->name('settlement_personal_topup_bonus')->withoutOverlapping();
//        $schedule->call('App\Http\Controllers\Admin\TransactionPointPurchaseController@teamCarAndHouseBonus')->everyMinute()->name('settlement_personal_topup_bonus')->withoutOverlapping();

        // calculate daily transaction
        $schedule->call('App\Http\Controllers\Admin\PointsController@topup_balance')->dailyAt('00:05')->name('daily_top_up')->withoutOverlapping();
        $schedule->call('App\Http\Controllers\Admin\PointsController@redemption_balance')->dailyAt('01:05')->name('daily_redemption')->withoutOverlapping();
        $schedule->call('App\Http\Controllers\Admin\PointsController@convert_balance')->dailyAt('01:05')->name('daily_point_convert')->withoutOverlapping();
        // $schedule->call('App\Http\Controllers\Admin\PointsController@vip_redemption_balance')->dailyAt('01:06')->name('daily_vip_redemption')->withoutOverlapping();

        $schedule->call('App\Http\Controllers\Admin\CronJobController@upgradeMillionaireLeaderStatus')->dailyAt('00:30')->name('upgrade_milliionaire_leader_status')->withoutOverlapping();
//        $schedule->call('App\Http\Controllers\Admin\CronJobController@teamCarAndHouseBonus')->dailyAt('00:32')->name('team_car_house_bonus')->withoutOverlapping();
        $schedule->call('App\Http\Controllers\Admin\CronJobController@teamCarAndHouseBonus')->everyMinute()->name('team_car_house_bonus')->withoutOverlapping();
        $schedule->call('App\Http\Controllers\Admin\CronJobController@referralBonusFirstGeneration')->dailyAt('00:34')->name('referral_bonus_first_upline')->withoutOverlapping();
        $schedule->call('App\Http\Controllers\Admin\CronJobController@topUpBonusFirstGeneration')->dailyAt('00:36')->name('topup_bonus_first_upline')->withoutOverlapping();
        $schedule->call('App\Http\Controllers\Admin\CronJobController@onHoldTopUpBonusFirstGeneration')->dailyAt('00:38')->name('onhold_topup_bonus_first_upline')->withoutOverlapping();

        $schedule->command('telescope:prune')->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
