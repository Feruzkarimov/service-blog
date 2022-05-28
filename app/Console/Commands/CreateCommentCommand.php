<?php

namespace App\Console\Commands;

use App\Models\Comment;
use Illuminate\Console\Command;
use Illuminate\Support\Str;


class CreateCommentCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'comment:create {--count=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new comment';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $count = $this->option('count');

        for ($i=1; $i <= $count; $i++) {
            $text = Str::random(length: 25);
            $post_id = rand($min = 1, $max = 1000);
            $user_id = rand($min = 1, $max = 1000);
            Comment::create([
                'text' => $text,
                'post_id' => $post_id,
                'user_id' => $user_id
            ]);
        }

        $this->info('Succesfully created ' . $count . ' comments');
    }
}
