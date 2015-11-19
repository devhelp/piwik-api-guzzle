<?php

namespace Devhelp\Piwik\Api\Guzzle\Client;

use Devhelp\Piwik\Api\Client\PiwikClient;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Wrapper for guzzle http client for the Method class
 */
class PiwikGuzzleClient implements PiwikClient
{
    /**
     * @var ClientInterface
     */
    private $guzzleClient;

    private $method = 'post';

    public function __construct(ClientInterface $guzzleClient)
    {
        $this->guzzleClient = $guzzleClient;
    }

    public function setRequestMethod($method)
    {
        $this->method = $method;
    }

    /**
     * @param string $url base piwik api url
     * @param array $params api parameters
     * @return ResponseInterface
     */
    public function call($url, array $params = [])
    {
        return $this->guzzleClient->request($this->method, $url, ['query' => $params]);
    }
}
