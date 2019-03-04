<?php

namespace NotificationChannels\Basecamp\Exceptions;

class CouldNotSendNotification extends \Exception
{
    public static function serviceRespondedWithAnError($response)
    {
        return new static("This message could not be sent to your Campfire");
    }
}
