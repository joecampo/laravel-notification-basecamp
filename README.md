# laravel-notification-basecamp

Basecamp 3 Chatbot Campfire notification channel for Laravel.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/joecampo/laravel-notification-basecamp.svg?style=flat-square)](https://packagist.org/packages/joecampo/laravel-notification-basecamp)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/joecampo/laravel-notification-basecamp/master.svg?style=flat-square)](https://travis-ci.org/joecampo/laravel-notification-basecamp)
[![Total Downloads](https://img.shields.io/packagist/dt/joecampo/laravel-notification-basecamp.svg?style=flat-square)](https://packagist.org/packages/joecampo/laravel-notification-basecamp)

## Installation

You can install the package via composer:

``` bash
composer require joecampo/laravel-notification-basecamp
```

## Usage

Within a Laravel notification you can now use this as a channel for ```via()```

```php
use Illuminate\Notifications\Notification;
use NotificationChannels\Basecamp\CampfireChannel;
use NotificationChannels\Basecamp\CampfireMessage;


class ReviewCreated extends Notification
{
    public function via($notifiable)
    {
        return [CampfireChannel::class];
    }

    public function toCampfire($notifiable)
    {
        return CampfireMessage::create()->data('Hello from my chatbot 🤖');
    }
}
```

You'll need to implement a ```routeNotificationForBasecamp``` method on your notifiable model that returns the webhook URL provided by Basecamp 3 for your Chatbot. ([Setting up a Basecamp 3 Chatbot](https://m.signalvnoise.com/new-in-basecamp-3-chatbots/))

```php
    public function routeNotificationForBasecamp()
    {
        return 'https://basecamp3.lvh.me';
    }
```

## Messages

Basecamp allows Chatbots to post the following tags ```table``` ```tr``` ```td``` ```th``` ```thead``` ```tbody``` ```details``` ```summary```. You may use the following standard HTML tags in rich text content: ```div```, ```h1```, ```br```, ```strong```, ```em```, ```strike```, ```a``` (with an href attribute), ```pre```, ```ol```, ```ul```, ```li```, and ```blockquote```.

This package provides helpers for a simple message, and details/summary messages.

### Simple message

```php
 CampfireMessage::create()->data("It Doesn't Have To Be Crazy At Work");
```

### Summary w/ details

The summary will show and the details will be hidden unless clicked. This is good for displaying messages that might have long stack traces etc.

```php
CampfireMessage::create()
  ->summary('This is the text/markup used as the summary')
  ->details('This is the text/markup that is hidden unless clicked on in the UI');
```

## Testing

``` bash
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
