<?php

namespace JWorksUK\Mondo\FeedItems;

use LogicException;

class FeedItem
{
    private $data = [];

    public function __construct(
        $title,
        $image_url,
        $background_color = '',
        $body_color = '',
        $title_color = '',
        $body = ''
    ) {
        $this->title = $title;
        $this->image_url = $image_url;
        $this->background_color = $background_color;
        $this->body_color = $body_color;
        $this->title_color = $title_color;
        $this->body = $body;
    }

    public function toArray()
    {
        return $this->data;
    }

    public function __set($name, $value)
    {
        // Title Must be string
        if (in_array($name, ['title']) && !is_string($value)) {
            throw new LogicException('Title must be string.');
        }

        // Is image a url
        if ($name == 'image_url' && !filter_var($value, FILTER_VALIDATE_URL)) {
            throw new LogicException('Invalid URL.');
        }

        if (in_array($name, ['background_color', 'body_color', 'title_color'])
            && !empty($value) && !$this->isHexColour($value)
        ) {
            throw new LogicException("$name must be a color hex.");
        }

        return $this->data[$name] = $value;
    }

    public function isHexColour($color)
    {
        preg_match('/#([a-f0-9]{3}){1,2}\b/i', $color, $matches);
        if (isset($matches[0])) {
            return true;
        }

        return false;
    }
}
