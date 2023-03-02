<?php

namespace Tests\Unit\Console\Commands;

use App\Console\Commands\AuthCommand;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Passport\Client;
use Laravel\Passport\Passport;
use Tests\TestCase;

class AuthCommandTest extends TestCase
{
    use RefreshDatabase;

    public function testAuthCommandWithValidCredentials()
    {
        // Create a user with valid credentials
        $user = User::create([
            'username' => 'johndoe',
            'email' => 'test@inbox.ru',
            'name' => 'asd',
            'password' => bcrypt('password'),
        ]);
        $this->artisan('passport:install');
        $this->assertTrue(Auth::attempt(["username"=>"$user->username","password"=>"password"]));
        $output = $this->artisan('user:auth', [
            'username' => 'johndoe',
            'password' => 'password'
        ]);

        $this->assertNotNull($user->tokens);

    }

    public function testAuthCommandWithInvalidCredentials()
    {
        // Mock the input to the console command
        $this->artisan('user:auth', [
            'username' => 'invalid',
            'password' => 'credentials'
        ])->expectsOutput('Invalid login credentials.');

        $this->assertFalse(Auth::check());
    }
}
