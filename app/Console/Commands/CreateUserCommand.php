<?php

namespace App\Console\Commands;

use App\Models\User;
use Faker\Factory;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {--count=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $count = $this->option('count');

        for ($i=1; $i <= $count; $i++) {
            $name = Factory::create()->name;
            User::create([
                'name' => $name,
            ]);
        }

        $this->info('Succesfully created ' . $count . ' users');
    }
}
