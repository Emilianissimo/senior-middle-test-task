<?php

namespace Tests\Unit;

use Core\Payload;
use Core\MessageHandler;
use PHPUnit\Framework\TestCase;

class MessageHandlerTest extends TestCase
{
    private $messageHandler;

    public function __construct(){
        parent::__construct();
        $this->messageHandler = new MessageHandler;
    }

    /**
     * @throws \Exception
     */
    public function sendMessageTelegramTest(){
        $result = $this->messageHandler->handle(new Payload(
            '{"type":"telegram", "message":"Hi, damn, desu"}'
        ));
        // Not sure about what have to be returned btw
        $this->assertSame($result->getProcessedRequest()['response'], '{"status":"ok", "source":"telegram", "messages":"single"}');
    }

    /**
     * @throws \Exception
     */
    public function  sendMessageTelegramBulkTest(){
        $result = $this->messageHandler->handle(new Payload(
            '{"type":"telegram", "message":["Hi, damn, desu", "Bye, damn, desu"]}'
        ));
        $this->assertSame($result->getProcessedRequest()['response'], '{"status":"ok", "source":"telegram", "messages":"bulk"}');
    }

    /**
     * @throws \Exception
     */
    public function sendMessageWhatsappTest(){
        $result = $this->messageHandler->handle(new Payload(
            '{"type":"whatsapp", "message":"Hi, damn, desu"}'
        ));
        $this->assertSame($result->getProcessedRequest()['response'], '{"status":"ok", "source":"whatsapp"}');
    }

    /**
     * @throws \Exception
     */
    public function sendMessageOneSignalTest(){
        $result = $this->messageHandler->handle(new Payload(
            '{"type":"push", "message":"Hi, damn, desu"}'
        ));
        $this->assertSame($result->getProcessedRequest()['response'], '{"status":"ok", "source":"onesignal"}');
    }
}
