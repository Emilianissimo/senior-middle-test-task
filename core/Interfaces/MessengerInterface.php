<?php

namespace Core\Interfaces;

interface MessengerInterface{
    public function send($message): string;
}
