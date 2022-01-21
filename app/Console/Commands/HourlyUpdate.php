<?php

namespace App\Console\Commands;

use App\Models\SMSGroup;
use Illuminate\Console\Command;

class HourlyUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hour:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an hourly email to all the users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
      $s=  SMSGroup::where('sent', 'false')->get();
      foreach ($s as $key ) {
          # code...
          $key->sent='true';
          $key->save();
      }
        return 'cdcdc';
    }
}
