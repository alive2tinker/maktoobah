<?php

namespace App\Listeners;

use App\Events\FavoriteCreated;
use App\Notifications\NewFavoriteNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  FavoriteCreated  $event
     * @return void
     */
    public function handle(FavoriteCreated $event)
    {
        $event->favorite->favorable->notify(new NewFavoriteNotification($event->favorite));
    }
}
