<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\SessionCookieJar;
use GuzzleHttp\Exception\RequestException;

class HealthAPI
{
    private $client;

    private $userAgent;

    private $cookieJar;

    private $access_token;

    public function __construct()
    {
        $this->cookieJar = new SessionCookieJar('SESSION_STORAGE', true);
        $this->client = new Client([
            'base_uri' => config('constants.API_BASE_URL'),
            'cookies' => $this->cookieJar
        ]);
        $this->access_token = null;
    }

    public function get($url, $token = null, $debug = false, $verify = false) {
        return $this->request('GET', $url, $token, [], $debug, $verify);
    }

    public function post($url, $arguments = [], $token = null, $debug = false, $verify = false) {
        return $this->request('POST', $url, $token, $arguments, $debug, $verify);
    }

    public function put($url, $arguments = [], $token = null, $debug = false, $verify = false) {
        $arguments['_method'] = 'PUT';

        return $this->request('POST', $url, $token, $arguments, $debug, $verify);
    }

    public function delete($url, $token = null, $debug = false, $verify = false) {
        return $this->request('DELETE', $url, $token, [], $debug, $verify);
    }

    private function request($type, $url, $token, $arguments, $debug, $verify) {

        if($token){
            $token_type = \Session::get('token_type');
            $hash = \Session::get('access_token');
            $this->access_token = $token_type.' '.$hash;
        }

        $options = [
            'allow_redirects' => true,
            'headers' => [
                'User-Agent' => $this->userAgent,
                'Accept' => 'application/json',
                'X-Requested-With' => 'XMLHttpRequest',
                'Authorization' => $this->access_token,
            ],
            'debug' => $debug,
            'verify' => $verify,
        ];

        if ($type == 'POST') {
            $options['form_params'] = $arguments;
        }

        try {
            $response = $this->client->request($type, $url, $options);
            return $response;
        } catch (RequestException $e) {
            return $e->getResponse();
        }
    }

}