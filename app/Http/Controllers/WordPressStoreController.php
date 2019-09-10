<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client as GuzzleClient;

class WordPressStoreController extends Controller
{

    public function store()
    {
        $key = Str::random(50);
        $email = auth()->user()->email;

        $guzzleClient = new GuzzleClient;
        $response = $guzzleClient->post('https://store.connectioncoin.com/wp-json/connectioncoin/v1/store/user/key', [
            'form_params' => [
                'email' => $email,
                'key' => $key
            ]
        ]);

        return redirect()->to('https://store.connectioncoin.com/?key=' . $key . '&email=' . $email);

    }

}
