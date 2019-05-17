<?php

namespace App\Jobs;

use AfricasTalking\SDK\AfricasTalking;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public  $phone;
    public  $message;
    public function __construct($phone, $message)
    {
       $this->phone=$phone;
       $this->message=$message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       $this->sms($this->phone, $this->message);
    }

    private function sms($phone, $message){
        $username = env('SMS_USER');
        $apiKey   = env('SMS_KEY');
        $AT       = new AfricasTalking($username, $apiKey);
        $sms      = $AT->sms();
        $result   = $sms->send([
            'to'      => $phone,
            'message' => $message
        ]);
        //dd($result);
    }
}
