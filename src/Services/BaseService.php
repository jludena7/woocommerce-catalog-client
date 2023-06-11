<?php

namespace WcCatalog\Services;

use GuzzleHttp\Exception\GuzzleException;
use WcCatalog\Helpers\Config;
use WcCatalog\Helpers\HttpClient;

class BaseService
{
    /**
     * @var Config
     */
    protected $config;

    protected $logger;

    /**
     * @param Config $config
     * @param $logger
     */
    public function __construct($config, $logger)
    {
        $this->config = $config;
        $this->logger = $logger;
    }

    /**
     * @param $uri
     * @param $data
     * @return false|mixed
     */
    protected function callCreate($uri, $data)
    {
        try {
            $client = HttpClient::create($this->config);

            $request = $client->post(
                $uri,
                [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ],
                    'json' => $data,
                ]
            );

            return json_decode($request->getBody()->getContents());
        } catch (GuzzleException $e) {
            $this->logger->error(__METHOD__, [$e->getMessage()]);
        }

        return false;
    }

    protected function callGet($uri)
    {
        try {
            $client = HttpClient::create($this->config);

            $request = $client->get(
                $uri,
                [
                    'headers' => [
                        'Accept' => 'application/json',
                    ],
                ]
            );

            return json_decode($request->getBody()->getContents());
        } catch (GuzzleException $e) {
            $this->logger->error(__METHOD__, [$e->getMessage()]);
        }

        return null;
    }

    protected function callUpdate($uri, $data)
    {
        try {
            $client = HttpClient::create($this->config);

            $request = $client->put(
                $uri,
                [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ],
                    'json' => $data,
                ]
            );

            return json_decode($request->getBody()->getContents());
        } catch (GuzzleException $e) {
            $this->logger->error(__METHOD__, [$e->getMessage()]);
        }

        return false;
    }

    protected function callDelete($uri, $data)
    {
        try {
            $client = HttpClient::create($this->config);

            $request = $client->delete(
                $uri,
                [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ],
                    'json' => $data,
                ]
            );

            return json_decode($request->getBody()->getContents());
        } catch (GuzzleException $e) {
            $this->logger->error(__METHOD__, [$e->getMessage()]);
        }

        return false;
    }
}
