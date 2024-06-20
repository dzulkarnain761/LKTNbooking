<?php

namespace App\Console\Commands;

use App\Models\BookingVehicle;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class UpdateExpiredTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-expired-tasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the status of tasks that have passed their task date';


    public function __construct()
    {
        parent::__construct();
    }

    

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();

        BookingVehicle::where('status', 'approved')
            ->where('task_date', '<', $now)
            ->update(['status' => 'expired']);

        $this->info('Expired tasks have been updated.');
    }
}
