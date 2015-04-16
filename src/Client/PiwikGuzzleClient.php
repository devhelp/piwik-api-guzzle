<?php

namespace Devhelp\Piwik\Api\Guzzle\Client;

use Devhelp\Piwik\Api\Client\PiwikClient;
use Devhelp\Piwik\Api\Exception\InvalidResponse;
use GuzzleHttp\ClientInterface;

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

    public function call($url, array $params = array())
    {
        $request = $this->guzzleClient->createRequest($this->method, $url);

        $request->getQuery()->merge($params);

        $response = $this->guzzleClient->send($request);

        if ($response->getStatusCode() > 300) {
            throw new InvalidResponse('Api returned invalid status code: '.$response->getStatusCode(), $response);
        }

        return $response->getBody();
    }
}
