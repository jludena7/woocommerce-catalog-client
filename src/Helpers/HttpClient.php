<?php

namespace WcCatalog\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

class HttpClient
{
    public static function create(Config $config)
    {
        if ($config->getOnlyOAuth()) {
            $stack = HandlerStack::create();
            $oauth = new Oauth1([
                'consumer_key' => $config->getApiKeyWooCommerce(),
                'consumer_secret' => $config->getApiSecretWooCommerce(),
            ]);
            $stack->push($oauth);

            return new Client([
                'base_uri' => $config->getApiUrlWooCommerce(),
                'handler' => $stack,
                'auth' => 'oauth',
            ]);
        } else {
            return new Client([
                'base_uri' => $config->getApiUrlWooCommerce(),
                'auth' => [
                    $config->getApiKeyWooCommerce(),
                    $config->getApiSecretWooCommerce(),
                ],
            ]);
        }
    }
}