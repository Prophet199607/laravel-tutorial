<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Post;

class CreatePost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:create {title} {content=N/A}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new post';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $post = Post::create([
        //     'post_title' => $this->argument('title'), 
        //     'post_content' => $this->argument('content'), 
        //     'image_path' => 'post_images/default_image.jpg', 
        //     'status' => 1,
        //     'user_id' => 1
        // ]);

        // $this->info('created: ' . $post->post_title);


        $title = $this->ask('Enter a post title..');
        if ($this->confirm('Do you want to save this post? title: ' . $title)) {
            $post = Post::create([
                'post_title' => $title, 
                'post_content' => $this->argument('content'), 
                'image_path' => 'post_images/default_image.jpg', 
                'status' => 1,
                'user_id' => 1
            ]);
            $this->info('New post added');
            return;
        }
        $this->warn('Post was not saved!');
    }
}
