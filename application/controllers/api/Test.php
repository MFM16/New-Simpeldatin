<?php

use GuzzleHttp\Client;

class Test extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        $client = new Client([
            'base_uri' => 'https://simpeldatin.setjen.pertanian.go.id/api/'
        ]);

        $response = $client->request('GET', 'request');

        var_dump($response);
    }

    public function insert()
    {
    }
}
