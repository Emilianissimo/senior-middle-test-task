<?php

namespace Core;

use Core\Interfaces\MessengerInterface;
use Core\Remote\OneSignalService;
use Core\Remote\TelegramMessenger;
use Core\Interfaces\MessageInterface;
use Core\Remote\WhatsappMessenger;
use Core\Validators\BulkMessagesValidator;
use Core\Validators\MessageValidator;
use Utils\Logger;

class MessageHandler {
    /**
     *Handle a payload, send the message
     *and return infomation about result
     * @return MessageInterface Payload object
     * @throws \Exception
     */
	public function handle(MessageInterface $payload): MessageInterface
	{
        Logger::info('Starting to run payload through messenger');
        $type = $payload->getType();
        $messages = $payload->getMessages();
        try{
            $payload->setProcessedRequest([
                'type'     => $type,
                'messages' => $messages
            ]);

            $service = $this->setServiceInstance($type);
            $response = $service->send($messages);

            $payload->setProcessedResponse(json_decode($response));

            return $payload;
        }catch(\Exception $e){
            Logger::error($e->getMessage());
            throw new \Exception($e->getMessage());
        }
	}

    private function setServiceInstance(string $type): MessengerInterface
    {
        Logger::info('Setting service, accorded to it\'s type: '. $type);

        switch($type){
            case 'push':
                $service = new OneSignalService(new MessageValidator());
                break;
            case 'whatsapp':
                $service = new WhatsappMessenger(new MessageValidator);
                break;
            default:
                $service = new TelegramMessenger(new BulkMessagesValidator);
                break;
        }
        return $service;
    }
}
