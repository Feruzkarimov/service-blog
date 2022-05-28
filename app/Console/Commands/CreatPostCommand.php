<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;


class CreatPostCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:create {--count=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new post';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       
        $count = $this->option('count');

        for ($i=1; $i <= $count; $i++) {
            $name = Str::random(length: 8);
            $user_id = rand($min = 1, $max = 1000);
            Post::create([
                'name' => $name,
                'user_id' => $user_id
            ]);
        }

        $this->info('Succesfully created ' . $count . ' posts');
    }
}