<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create or update admin user account';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = 'eto-ministries@outlook.com';
        $password = 'password123';

        // Delete any existing admin users
        User::where('email', 'admin@educatetheorphans.org')->delete();
        User::where('email', $email)->delete();

        // Create new admin user
        $user = User::create([
            'name' => 'ETO Admin',
            'email' => $email,
            'password' => bcrypt($password),
        ]);

        $this->info('Admin user created successfully!');
        $this->info('Email: ' . $email);
        $this->info('Password: ' . $password);
        $this->warn('Please change the password after first login.');

        return Command::SUCCESS;
    }
}
