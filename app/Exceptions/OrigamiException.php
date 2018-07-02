<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class OrigamiException extends HttpException
{
    private $errors = [];
    private $statusCode;

    public function __construct($detail = null, $code = 0)
    {
        $this->statusCode = 422;

        if ($detail != null)
            $this->addError($detail, $this->statusCode, $code);

        parent::__construct($this->statusCode);
    }

    public function addError(string $detail, $status = 422,  $code = 0)
    {
        $this->errors[] = [
            'status' => $status,
            'detail' => $detail,
            'code' => $code
        ];

        return $this;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
    }
}