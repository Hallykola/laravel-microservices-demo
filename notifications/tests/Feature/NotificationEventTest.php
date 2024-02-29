<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Log; 
use App\Jobs\UserCreatedJob;



class NotificationEventTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
   

    public function test_job_works()
    {
        // Queue::fake();
        $milliseconds = floor(microtime(true) * 1000);
        // concat time to always make email unique
        $email = $milliseconds."test@email.com";
        UserCreatedJob::dispatch( [
            "firstName"=>"TestFirstName",
            "lastName"=>"TestLastName",
            "email"=>$email,
            'updated_at'=>'2024-02-29 08:10:00',
           'created_at'=>'2024-02-29 08:10:00',
        ]);
        $this->assertDatabaseHas('usersnotifications',["email"=>$email]);
        
    
    }
}
