<?php

namespace CurrencyCloud\Exception;

use Exception;
class ApiException extends CurrencyCloudException
{
    /**
     * @var string
     */
    private $date;
    /**
     * @var string
     */
    private $requestId;
    /**
     * @var null|array
     */
    private $errors;
    /**
     * @var string
     */
    private $statusCode;

    /**
     * ApiException constructor.
     *
     * @param string $statusCode
     * @param string $date
     * @param string $requestId
     * @param array|null $errors
     * @param string $parameters
     * @param string $httpMethod
     * @param string $url
     * @param string $message
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct(
        $statusCode,
        $date,
        $requestId,
        $errors,
        $parameters,
        $httpMethod,
        $url,
        $message = '',
        $code = 0,
        Exception $previous = null
    ) {
        parent::__construct(
            $parameters,
            $httpMethod,
            $url,
            $message,
            $code,
            $previous
        );
        $this->date = $date;
        $this->requestId = $requestId;
        $this->errors = $errors;
        $this->statusCode = $statusCode;
    }

    protected function getCompileProperties()
    {
        $temp = [
            'response' => [
                'status_code' => $this->statusCode,
                'date' => $this->date,
                'request_id' => $this->requestId
            ]
        ];
        if (null !== $this->errors) {
            $temp['errors'] = $this->errors;
        }
        return parent::getCompileProperties() + $temp;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getRequestId()
    {
        return $this->requestId;
    }

    /**
     * @return null|array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return string
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
}
