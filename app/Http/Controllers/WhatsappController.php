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
            'Authorization' => 'Bearer EAAC4R0lXjZBABAN6ilL4UyP6jKcHB1XtmbZCz01x6CB9gYw3AF4zzr2pNT1ZBTOX63UXxhM64zIrICi2rjBZBt95Y8PB904sQPBzEqG2xP60t8mxwBCUH5FA1VYcArlw1GFz9fZC1NrdBZBbMY3NpOuJudaZBnOResBtdbcqVOpr9y5d1Dn2fYHVR1ZAEI4ZAIeTIEjYfblcUhyLlDaWglM8j'
        ];
        $body = '{
                    "messaging_product": "whatsapp",
                    "to": "628112650159",
                    "type": "template",
                    "template": {
                        "name": "informasi_pengerjaan_unit",
                        "language": {
                        "code": "id"
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
