<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Usersnotification;
use Illuminate\Support\Facades\Log; 

class UserCreatedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        
            $details = [
                
                'firstName'=>$this->data['firstName'],
                'lastName'=>$this->data['lastName'],
                'email'=>$this->data['email'],
                'updated_at'=>$this->data['updated_at'],
                'created_at'=>$this->data['created_at'],
            ];
            Usersnotification::create($details);
            $message = "Account Creation completed". json_encode($details);
            Log::info($message);
    }
}
