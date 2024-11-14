<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class NewCommentNotify extends Notification implements ShouldQueue
{
    use Queueable;

    private $comment;
    private $post;
    /**
     * Create a new notification instance.
     */
    public function __construct($comment , $post)
    {
        $this->comment = $comment;
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }



    public function toArray(object $notifiable): array
    {
        return [

        ];
    }

    public function toDatabase(object $notifiable)
    {
            return [
                'user_id'=>$this->comment->user_id,
                'post_id'=>$this->comment->post_id,
                'post_title'=>$this->post->title,
                'comment'=>$this->comment->comment,
                'username'=>Auth::user()->name,
                'post_slug'=>$this->post->slug,
                ];
    }
    public function toBroadcast(object $notifiable)
    {
        return [
            'user_id'=>$this->comment->user_id,
            'post_id'=>$this->comment->post_id,
            'post_title'=>$this->post->title,
            'comment'=>$this->comment->comment,
            'username'=>Auth::user()->name,
            'post_slug'=>$this->post->slug,
        ];
    }

    /*public function broadcastType(): string
    {
        return 'NewCommentNotify';
    }*/


}
