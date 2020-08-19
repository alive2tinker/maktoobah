<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewMessageNotification extends Notification
{
    use Queueable;

    public $message;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($nuMessage)
    {
        $this->message = $nuMessage;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast', 'database','mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(trans('strings.new_favorite_notification'))
            ->greeting(trans('strings.hello') . $notifiable->name)
            ->line(trans('strings.user') . " " . $this->message->user->name . " " .trans("strings.has_sent_amessage"))
            ->action(trans('strings.view_message'), route('chats.show', $this->message->chat->id))
            ->line(trans('strings.thanks'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'link' => route('chats.show', $this->message->chat->id),
            'message' => trans('strings.user') . " " . $this->message->user->name . " " .trans("strings.has_sent_amessage")
        ];
    }

    public function toBroadcast($notifiable)
    {
        return [
            'link' => route('chats.show', $this->message->chat->id),
            'message' => trans('strings.user') . " " . $this->message->user->name . " " .trans("strings.has_sent_amessage")
        ];
    }
}
