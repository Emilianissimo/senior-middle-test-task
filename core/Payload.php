<?php

namespace Core;

use Core\Interfaces\MessageInterface;

class Payload implements MessageInterface {

    private $data;

    /**
     * @var false|resource
     */
    private $request;

    /**
     * @var bool|string
     */
    private $response;

    public function __construct($dataJSON){
        $this->data = json_decode($dataJSON);
    }

	/**
	*Get the type of a message

	*@return string Following types: "messenger:(telegram|whatsapp)", "push"
	*/
	public function getType(): string
	{
        return $this->data['type'];
	}

	/**
	*Get messages from payload

	*@return array ["message text N""]
	*/
	public function getMessages(): array
	{
		return $this->data['message'];
	}

    /**
     * @throws Exception
     */
    public function setProcessedRequest(array $data)
	{
        $this->request = $data;
	}

    public function setProcessedResponse(array $data){
        $this->response = $data;
    }

	/**
	*Get information about processing the payload 

	*@return array ["request" => "body", "response" => "body"]
	*/
	public function getProcessedRequest(): array
	{
		return [
            'request' => $this->request,
            'response' => $this->response
        ];
	}
}
