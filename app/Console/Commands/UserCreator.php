<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class UserCreator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:user:create {--email= : User email}}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->option('email');
        if (!$email) {
            $this->error('Email is required');
            $this->info('Usage: php artisan app:user:create --email="..."');
            return self::FAILURE;
        }

        $exist = User::where('email', $email)->first();
        if ($exist !== null) {
            $this->error('User already exists');
            return self::FAILURE;
        }

        $name = $this->ask('Name?');

        $this->line($name);
        $this->line($email);

        $password = $this->secret('Password?');
        $this->line($password);
        // $this->info("User $password created");

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->save();
        
        $this->info("User $name created");
        
        $this->table(
            ['Name', 'Email', 'Password'],
            [[$name, $email, $password]]
        );

        return self::SUCCESS;
    }
}
