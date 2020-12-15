<?php

namespace App\Console\Commands;

use App\Events\TheSameDay;
use App\Notifications\NotifyForTheCurrentServices;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\Subscribe;
class NotifyTheUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'service:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the script and find the today services and notify the user with it';

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
     * @return mixed
     */
    public function handle()
    {
        $all=Subscribe::with('user')->where('status',true)->whereDate('endDate',Carbon::now())->get();
        foreach ($all as $one){
            $one->status=true;
            $one->save();
            $one->user->readNotifications()->delete();
            $one->user->notify(new NotifyForTheCurrentServices($one));
            event(new TheSameDay($one));
        }
    }
}
