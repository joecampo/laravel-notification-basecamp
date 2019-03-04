<?php
//@codingStandardsIgnoreStart
namespace NotificationChannels\Basecamp\Test;

use Orchestra\Testbench\TestCase;
use NotificationChannels\Basecamp\CampfireMessage;

class CampfireMessageTest extends TestCase
{
    /** @test **/
    public function can_set_data_on_a_message()
    {
        $this->assertEquals(
            ['content' => '<summary>hello world</summary>'],
            CampfireMessage::create()
                ->data('hello world')
                ->toArray()
        );
    }
    
    /** @test **/
    public function can_set_summary_and_details_on_a_message()
    {
        $this->assertEquals(
            ['content' => '<summary>hello world</summary><details>some spicy details</details>'],
            CampfireMessage::create()
                ->summary('hello world')
                ->details('some spicy details')
                ->toArray()
        );
    }
}
