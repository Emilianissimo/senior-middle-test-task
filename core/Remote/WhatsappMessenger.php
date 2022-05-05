<?php

namespace Core\Remote;

use Core\Exceptions\RemoteServiceException;
use Core\Exceptions\RemoteValidationException;
use Core\Helpers\CURL;
use Core\Interfaces\MessengerInterface;
use Core\Interfaces\ValidatorInterface;
use Utils\Logger;

class WhatsappMessenger implements MessengerInterface {

    /**
     * @var ValidatorInterface
     */
    public $validator;

    /**
     * @param ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     *Send a message to Telegram
     * @return string Return a string response from remote service
     * @throws RemoteServiceException|RemoteValidationException
     */
	public function send($message): string
	{
        Logger::debug('Checking that the message is instance of array or string for whatsapp');
        $this->validator->validate($message);
		return CURL::post(
            env('WHATSAPP_API_URL'),
            ['message' => $message]
        );
	}
}
