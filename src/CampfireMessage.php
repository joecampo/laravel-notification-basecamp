<?php

namespace NotificationChannels\Basecamp;

class CampfireMessage
{
    protected $summary;

    protected $details;

    /**
     * Create a new Campfire message.
     *
     * @return void
     */
    public static function create()
    {
        return new static;
    }

    /**
     * Simply just send data through to your Campfire.
     * https://github.com/basecamp/bc3-api/blob/master/sections/rich_text.md
     *
     * @param  string  $data
     * @return this
     */
    public function data($data)
    {
        return $this->summary($data);
    }

    /**
     * Set the summary text when using details.
     *
     * @param  string  $summary
     * @return this
     */
    public function summary($summary)
    {
        $this->summary = sprintf('<summary>%s</summary>', $summary);

        return $this;
    }

    /**
     * Set the details that will be displayed in a dropdown.
     *
     * @param  string  $details
     * @return this
     */
    public function details($details)
    {
        $this->details = sprintf('<details>%s</details>', $details);

        return $this;
    }

    /**
     * Return the message an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'content' => implode('', get_object_vars($this))
        ];
    }
}
