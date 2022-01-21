<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use AfricasTalking\SDK\AfricasTalking;
use App\Models\SMSGroup;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\HourlyUpdate::class
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

        $schedule->job(function () {
            print_r('schedules');

            $mytime = \Carbon\Carbon::now();
     
            $username = 'payspap'; // use 'sandbox' for development in the test environment
            $apiKey   = '16544c7fe647e8e098efdead113123abc81fb77b028c1edc6edc95d48361aafd'; // use your sandbox app API key for development in the test environment
            $AT       = new AfricasTalking($username, $apiKey);
            $sms      = $AT->sms(); 
            
            $s =  SMSGroup::where('sent', 'false')->get();
            foreach ($s as $key) {
                # code...
                
                $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $key->timeframe);
                $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $mytime->toDateTimeString());
                $diff_in_minutes = $to->diffInHours($from);
                
          if ($diff_in_minutes<3) {
              # code...
              $result   = $sms->send([
                'to'      => json_decode($key->numbers),
                'message' => $key->sms .$diff_in_minutes
            ]);
            $key->sent = 'true';
            $key->save();
          }
            }
            // return $result;
        })->everyMinute();

        $schedule->command('hourly:update')
            ->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
