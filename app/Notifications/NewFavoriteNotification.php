<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewFavoriteNotification extends Notification
{
    use Queueable;

    public $favorite;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($nuFavorite)
    {
        $this->favorite = $nuFavorite;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast','database','mail'];
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
            ->line(trans('strings.user') . " " . $this->favorite->user->name . " " . trans('strings.has_favorited_you'))
            ->action(trans('strings.view_person'), route('users.show', $this->favorite->user->id))
            ->line(trans('strings.thanks'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'link' => route('users.show', $this->favorite->user->id),
            'message' => trans('strings.user') . " " . $this->favorite->user->name . " " .trans("strings.has_favorited_you")
        ];
    }

    public function toBroadcast()
    {
        return [
            'link' => route('users.show', $this->favorite->user->id),
            'message' => trans('strings.user') . " " . $this->favorite->user->name . " " .trans("strings.has_favorited_you")
        ];
    }
}
