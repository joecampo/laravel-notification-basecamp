<?php

namespace NotificationChannels\Basecamp;

use GuzzleHttp\Client;
use Illuminate\Notifications\Notification;

class CampfireChannel
{
    protected $client;

    /**
     * @param  Client  $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @throws \NotificationChannels\Basecamp\Exceptions\CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {
        if (! $url = $notifiable->routeNotificationFor('Basecamp')) {
            return;
        }

        $response = $this->client->post($url, [
            'json' => $notification->toCampfire($notifiable)->toArray()
        ]);

        if ($response->getStatusCode() !== 201) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($response);
        }
    }
}
