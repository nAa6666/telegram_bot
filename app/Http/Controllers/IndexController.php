<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexRequest;
use Carbon\Carbon;
use GuzzleHttp\Client;

class IndexController extends Controller
{
    public function show()
    {
        return view('index');
    }

    public function send(IndexRequest $request, Client $client)
    {
        $text = "<b>domain.com</b>";
        $text .= "\n".sprintf("<b>Title:</b> %s", $request->title);
        $text .= sprintf("\n<b>Text:</b> %s", $request->text);
        $text .= "\n".sprintf("<b>Date:</b> %s", Carbon::now()->isoFormat('DD.MM.Y H:m'));

        try{
            $result = $client->post('https://api.telegram.org/bot'. env('TELEGRAM_TOKEN') .'/sendMessage', [
                'query' => [
                    'chat_id' => env('TELEGRAM_CHAT'),
                    'text' => $text,
                    'parse_mode' => 'html'
                ]
            ])->getBody()->getContents();

            $result = json_decode($result, true);

            if(isset($result['ok'])){
                return view('index')->with(['success' => 'Form submitted successfully!']);
            }
            return view('index')->withErrors(['Failed to send messages!']);
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }
}
