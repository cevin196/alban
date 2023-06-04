<?php

namespace App\Http\Controllers;

use App\Models\Admin\ConditionReport;
use App\Models\Admin\Job;
use App\Models\Admin\Picture;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request as Psr7Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class ConditionReportController extends Controller
{
    public function store(Request $request)
    {
        dd($request);
        $validated = $request->validate([
            'name' => 'required',
            'weight' => 'required|integer|between:1,5',
            'unit' => 'required|string|max:100',
        ]);

        ConditionReport::create([
            'name' => $request->name,
            'date' => $request->date
        ]);
    }

    public function edit(ConditionReport $conditionReport)
    {

        return view('admin.conditionReport.edit', compact('conditionReport'));
    }

    public function print(ConditionReport $conditionReport)
    {
        $job = Job::find($conditionReport->job_id);
        $pictures = Picture::where('condition_report_id', $conditionReport->id)->get();

        return view('admin.conditionReport.print', compact('conditionReport', 'job', 'pictures'));
    }

    public function send()
    {

        $client = new Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer TOKEN'
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
                            "type": "header",
                            "parameters": [
                            {
                                "type": "text",
                                "text": "unit c3s"
                            }
                            ]
                        },
                        ]
                    }
                }';
        try {
            $request = new Psr7Request('POST', 'https://graph.facebook.com/v16.0/117461978013918/messages', $headers, $body);
            $res = $client->sendAsync($request)->wait();
            notify()->success('Message Sended');
            return redirect()->back();
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            notify()->error($responseBodyAsString);
            return redirect()->back();
        }
    }
}
