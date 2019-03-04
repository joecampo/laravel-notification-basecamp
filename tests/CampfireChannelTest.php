<?php
//@codingStandardsIgnoreStart
namespace NotificationChannels\Basecamp\Test;

use Mockery;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Orchestra\Testbench\TestCase;
use Illuminate\Notifications\Notification;
use NotificationChannels\Basecamp\CampfireChannel;
use NotificationChannels\Basecamp\CampfireMessage;

class CampfireChannelTest extends TestCase
{
    /** @test */
    public function can_send_a_notification_to_campfire()
    {
        $client = Mockery::mock(Client::class)
                    ->shouldReceive('post')
                    ->with(
                        'https://basecamp3.lvh.me',
                        [
                            'json' => ['content' => '<summary>It Doesn\'t Have To Be Crazy At Work</summary>']
                        ]
                    )
                    ->andReturn(new Response(201))
                    ->getMock();

        $campfire = new CampfireChannel($client);
        $campfire->send(new TestNotifiable(), new TestNotification());
    }
}

class TestNotifiable
{
    use \Illuminate\Notifications\Notifiable;

    /**
     * @return string
     */
    public function routeNotificationForBasecamp()
    {
        return 'https://basecamp3.lvh.me';
    }
}

class TestNotification extends Notification
{
    /**
     * Test notification with routing to a Campfire.
     *
     * @param  mixed  $notifiable
     * @return void
     */
    public function toCampfire($notifiable)
    {
        return CampfireMessage::create()->data('It Doesn\'t Have To Be Crazy At Work');
    }
}
