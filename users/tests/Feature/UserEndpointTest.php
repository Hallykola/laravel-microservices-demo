<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Jobs\UserCreatedJob;
use App\Models\User;
use Illuminate\Support\Facades\Queue;




class UserEndpointTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_post_route_exist()
    {
        $response = $this->post('/api/user');

        $response->assertStatus(400);
    }
    public function test_user_post_route_works()
    {
        $milliseconds = floor(microtime(true) * 1000);
        // concat time to always make email unique
        $email = $milliseconds."test@email.com";
        $response = $this->post('/api/user',
        [
            "firstName"=>"TestFirstName",
            "lastName"=>"TestLastName",
            "email"=>$email
        ]
    );

        $response->assertStatus(201);
    }
    public function test_user_data_saves_in_db()
    {
        $milliseconds = floor(microtime(true) * 1000);
        // concat time to always make email unique
        $email = $milliseconds."test@email.com";
        User::create([
            "firstName"=>"TestFirstName",
            "lastName"=>"TestLastName",
            "email"=>$email,
    ]);
        $this->assertTrue(true);
    }

    
    public function test_data_is_saved_in_database_by_endpoint()
    {

        $milliseconds = floor(microtime(true) * 1000);
        // concat time to always make email unique
        $email = $milliseconds."test@email.com";
        $response = $this->post('/api/user',
        [
            "firstName"=>"TestFirstName",
            "lastName"=>"TestLastName",
            "email"=>$email
        ]
    );
    $this->assertDatabaseHas('users',["email"=>$email]);
    }
    
    public function test_event_is_dispatched_by_endpoint()
    {
        Queue::fake();
        $milliseconds = floor(microtime(true) * 1000);
        // concat time to always make email unique
        $email = $milliseconds."test@email.com";
        $response = $this->post('/api/user',
        [
            "firstName"=>"TestFirstName",
            "lastName"=>"TestLastName",
            "email"=>$email
        ]
    );
    Queue::assertPushed(UserCreatedJob::class, 1);
    }
    
}
