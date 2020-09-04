<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostSaveMail extends Mailable
{
    use Queueable, SerializesModels;

    public $post;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($post)
    {
        $this->post = $post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.post-save');
        // ->attachFromStorageDisk('public', 'post_images/PnUGZ8HVSzuPaGEonX2FQdw8E3h5PcHB3KUQPXL2.jpeg', 'default_image.jpg', [
        //     'as' => 'post-image.jpeg',
        //     'mime' => 'image/jpeg',
        // ]);
        // ->attach(public_path('storage/post_images/PnUGZ8HVSzuPaGEonX2FQdw8E3h5PcHB3KUQPXL2.jpeg'), [
        //     'as' => 'post-image.jpeg',
        //     'mime' => 'image/jpeg',
        // ]);
    }
}
