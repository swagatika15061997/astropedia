<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;


class ChatNotification extends Notification implements ShouldQueue
{
    use Queueable;
    protected $user;
    protected $astrologer;
    protected $message;

    /**
     * Create a new notification instance.
     */
    public function __construct($user, $astrologer, $message)
    {
        $this->astrologer = $astrologer;
        $this->user = $user;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database','mail','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->subject('New Chat Request')
        ->greeting('Hello ' . $this->astrologer->name . '!')
        ->line($this->user->name . ' has sent you a new chat request.')
        ->action('View Chat Request', url('/astrologer/chat/chat-requests')) // Adjust the URL to point to your chat system
        ->line('Thank you for using our application!')
        ->salutation('Regards, Your Application Name');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'user_id' => $this->user->id,
            'user_name' => $this->user->name,
            'user_image' => $this->user->image,
            'astrologer_id' => $this->astrologer->id,
            'message' => 'You have a new chat request from ' . $this->user->name,

        ];
    }
    public function toArray(object $notifiable): array
    {
        return [
            'user_id' => $this->user->id,
            'user_name' => $this->user->name,
            'astrologer_id' => $this->astrologer->id,
            'message' => 'You have a new chat request from ' . $this->user->name,

        ];
    }
    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'user_name' => $this->user->name,
            'user_image' => $this->user->profile_image ?? 'default.jpg', // Adjust according to your setup
            'message' => $this->message,
        ]);
    }
}
