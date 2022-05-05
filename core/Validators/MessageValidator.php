<?php


namespace Core\Validators;

use Core\Exceptions\RemoteValidationException;
use Core\Interfaces\ValidatorInterface;

class MessageValidator implements ValidatorInterface
{
    /**
     * @param array $message
     * @throws RemoteValidationException
     */
    public function validate($message): void
    {
        if (!is_array($message) && !is_string($message)) {
            throw new RemoteValidationException($message);
        }
    }
}
