<?php

namespace Core\Interfaces;

interface MessageInterface{
    public function getType(): string;

	public function getMessages(): array;

    public function setProcessedRequest(array $data);

    public function setProcessedResponse(array $data);

	public function getProcessedRequest(): array;
}
