<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WhatsappController extends Controller
{
    public function testRequest()
    {

        $client = new Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer EAAC4R0lXjZBABAOZBoTzQZBfRbkq3ffuyNI6WLmjPHzN0wn5YZAT08bXDuFVZCvJ37dzzZA76cV44oFPMjuZC0twc8mL3Ws4i0igQVIbhZBOSQhjXAmX1IyhcDP495ev14JJRts78tJ1hRSZBGK7wlZAhBxU173QFFaMHC9GEoo8NiLXqF3fpNZAmuUJYTp2rS9CKZBRZCJCMgONdZAPiOUgsd4r2e'
        ];
        $body = '{
                    "messaging_product": "whatsapp",
                    "to": "628112650159",
                    "type": "template",
                    "template": {
                        "name": "condition_report_user",
                        "language": {
                        "code": "en"
                        },
                        "components": [
                        {
                            "type": "body",
                            "parameters": [
                            {
                                "type": "text",
                                "text": "www.alban-technik-mandiri.com"
                            }
                            ]
                        },
                        {
                            "type":"button",
                            "sub_type": "url",
                            "index": 1,
                            "parameters": [
                                {
                                    "type": "text",
                                    "text": "http://localhost:8000/condition/print/2"
                                }
                            ]
                        }
                        
                        ]
                    }
                }';
        $request = new Psr7Request('POST', 'https://graph.facebook.com/v16.0/117461978013918/messages', $headers, $body);
        $res = $client->sendAsync($request)->wait();
        echo $res->getBody();

        // $client = new Client();
        // $headers = [
        //     'Content-Type' => 'application/json',
        //     'Authorization' => 'Bearer EAAC4R0lXjZBABAIx5ya7XksF8VVpaWT8h4KnQzE84u9Qw2ZCmKDhk5yATNFGzJIUOr3jGQAEYf9f9IgAeD1qJ40xiW3PP3T6NUpy9OCBd3NaZCUAQwZBHlmWg5DI27b4aGMP6xfsSZB4RccVW7mu46679UzM4iQJXQACTCbnZBF1DmqKOgRYpI02bUIkJB2FXcZCkUasRDC28NLE3SOBAgk'
        // ];
        // $body = '{
        //         "messaging_product": "whatsapp",
        //         "to": "628112650159",
        //             "text": {
        //                 "body": "test kirim wa dari web... info cevin kalau pesan ini masuk"
        //             }
        //         }';
        // $request = new Psr7Request('POST', 'https://graph.facebook.com/v16.0/106578912451479/messages', $headers, $body);
        // $res = $client->sendAsync($request)->wait();
        // echo $res->getBody();


    }
}
