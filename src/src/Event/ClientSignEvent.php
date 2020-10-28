<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;


class ClientSignEvent extends Event
{

    public const NAME = 'client.signed';

    private $title;

    private $message;

    public function __construct(String $title, String $message)
    {
        $this->title = $title;
        $this->message = $message;
    }

    public function getTitle()
    {

        return $this->title;
    }

    public function getMessage()
    {

        return $this->message;
    }
}
