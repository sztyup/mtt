<?php

namespace App\Api;

use GuzzleHttp\Client;

class BaseService
{
    protected function getClient(): Client
    {
        return new Client([
            'base_uri' => 'http://interview.mtt.digital:8093',
            'headers' => [
                'auth' => '<token>'
            ]
        ]);
    }

    /**
     * @param $endpoint
     * @param array $parameters
     *
     * @return array
     */
    protected function get($endpoint, $parameters = [])
    {
        $response = $this->getClient()->get($endpoint, [
            'form_params' => $parameters
        ]);
        $data = json_decode($response->getBody()->getContents(), true);

        if (array_key_exists('current_page', $data)) {
            $items = $data['data'];
            $last = $data['last_page'];
            for($i = 2; $i < $last; $i++) {
                $response = $this->getClient()->get(
                    $endpoint,
                    array_merge($parameters, [
                        'page' => $i
                    ])
                );
                $data = json_decode($response->getBody()->getContents(), true)['data'];
                foreach ($data as $item) {
                    $items[] = $item;
                }
            }

            return array_merge($items);
        }

        return $data;
    }

    /**
     * @param $endpoint
     * @param $parameters
     *
     * @return bool
     */
    protected function post($endpoint, $parameters)
    {
        $response = $this->getClient()->post($endpoint, [
            'json' => $parameters
        ]);

        return $response->getStatusCode() === 200;
    }

    /**
     * @return bool
     */
    public function reset()
    {
        $response = $this->getClient()->get('reset');

        return $response->getStatusCode() === 200;
    }
}
