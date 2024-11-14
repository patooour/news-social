<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewContactNotify extends Notification implements ShouldQueue
{
    use Queueable;

    private $contact;
    public function __construct($contact)
    {
        $this->contact = $contact;
    }


    public function via(object $notifiable): array
    {
        return ['database','broadcast'];
    }


    public function toArray(object $notifiable): array
    {
        return [
            'title'=>$this->contact->title,
            'name'=>$this->contact->name,
            'body'=>$this->contact->body,
            'date'=>$this->contact->created_at,
            'link'=>route('admin.contacts.show' ,$this->contact->id),
        ];
    }

    /*public function toDatabase(object $notifiable): array
    {
        return [
            'contactTitle'=>$this->contact->title,
            'contactBody'=>$this->contact->body,
            'username'=>$this->contact->name,
            'date'=>$this->contact->created_at,
            'link'=>route('admin.contacts.show' ,$this->contact->id),
        ];
    }
    public function toBroadcast(object $notifiable): array
    {
        return [
            'contactTitle'=>$this->contact->title,
            'contactBody'=>$this->contact->body,
            'username'=>$this->contact->name,
            'date'=>$this->contact->created_at,
            'link'=>route('admin.contacts.show' ,$this->contact->id),
        ];
    }*/

    public function broadcastType(): string
    {
        return 'ContactNotify';
    }

    public function databaseType(object $notifiable): string
    {
        return 'ContactNotify';
    }




}
