<?php

namespace App\Jobs;

use App\ApplicationForm;
use App\Mail\NotifyStudent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendingEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * SendingEmail constructor.
     * @param ApplicationForm $applicationForm
     */
    public $application;
    public function __construct($applicationForm)
    {
        $this->application=$applicationForm;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $study=$this->application->study->alias??$this->application->mission->study->alias;
        Mail::to($this->application->studentEmail)->send(new NotifyStudent($this->application->studentName,$study));
    }
}
