<?php

namespace CurrencyCloud;

use InvalidArgumentException;
use LogicException;

class Session
{

    const ENVIRONMENT_PRODUCTION    = 'prod';
    const ENVIRONMENT_DEMONSTRATION = 'demonstration';
    const ENVIRONMENT_UAT           = 'uat';

    private static $urls = [
        self::ENVIRONMENT_PRODUCTION => 'https://api.currencycloud.com/v2/',
        self::ENVIRONMENT_DEMONSTRATION => 'https://devapi.currencycloud.com/v2/',
        self::ENVIRONMENT_UAT => 'https://api-uat1.ccycloud.com'
    ];

    /**
     * @var string
     */
    private $apiUrl;

    /**
     * @var string
     */
    private $onBehalfOf;
    /**
     * @var string
     */
    private $loginId;
    /**
     * @var string
     */
    private $apiKey;
    /**
     * @var null|string
     */
    private $authToken;

    /**
     * @param string $environment
     * @param string $loginId
     * @param string $apiKey
     */
    public function __construct($environment, $loginId, $apiKey)
    {
        if (!isset(self::$urls[$environment])) {
            throw new InvalidArgumentException(
                sprintf(
                    'Invalid environment %s provided, expected one of [%s]',
                    $environment,
                    implode(', ', array_keys(self::$urls))
                )
            );
        }
        if (null === $loginId) {
            throw new InvalidArgumentException('Login ID can not be null');
        }
        if (null === $apiKey) {
            throw new InvalidArgumentException('API key can not be null');
        }
        $this->apiUrl = self::$urls[$environment];
        $this->loginId = (string) $loginId;
        $this->apiKey = (string) $apiKey;
    }

    /**
     *
     */
    public function clearOnBehalfOf()
    {
        $this->onBehalfOf = null;
    }

    /**
     * @return string
     */
    public function getOnBehalfOf()
    {
        return $this->onBehalfOf;
    }

    /**
     * @param string $contactId
     *
     * @throws InvalidArgumentException When contact ID is not UUID
     * @throws LogicException If already in on-behalf-of call
     */
    public function setOnBehalfOf($contactId)
    {
        $pattern = '/[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}/i';

        if (!is_string($contactId)
            || !preg_match($pattern, $contactId)
        ) {
            throw new InvalidArgumentException('Contact ID expected to be UUID');
        }

        if (null !== $this->onBehalfOf) {
            throw new LogicException(sprintf('Already in on-behalf-of call with ID: %s', $this->onBehalfOf));
        }

        $this->onBehalfOf = $contactId;
    }

    /**
     * @return string
     */
    public function getApiUrl()
    {
        return $this->apiUrl;
    }

    /**
     * @return string
     */
    public function getLoginId()
    {
        return $this->loginId;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @return null|string
     */
    public function getAuthToken()
    {
        return $this->authToken;
    }

    /**
     * @param null|string $authToken
     *
     * @return $this
     */
    public function setAuthToken($authToken)
    {
        $this->authToken = (null !== $authToken) ? (string) $authToken : null;
        return $this;
    }
}
