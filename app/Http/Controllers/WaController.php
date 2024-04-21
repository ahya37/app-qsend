<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Services\WaService;
use GuzzleHttp\Psr7\Request;

class WaController extends Controller
{
   
    public function textMessage()
    {
        $data = [
            'title' => 'Kirim Pesan'
        ];

        return view('whatsapp.textmessage', $data);
    }

    public function textMessageStore(MessageRequest $request)
    {
        $request_contacts = $request->validated();
        $request_contacts = $this->numberFormatter($request_contacts['contacts']);
        
        foreach ($request_contacts as $contact) {
            WaService::sendTextMessage($contact, $request->message);
        }

        return redirect()->route('message.create')->with(['success' => 'Pesan terkirim']);
    }

    public function qrcode()
    {
        $data = [
            'title' => 'Qr code'
        ];

        return view('whatsapp.qrcode-create', $data);
    }

    public function generateQrCode()
    {
        $results = WaService::generateQrcode();
        return $results;

    }

    private function numberFormatter($contacts)
    {
        $x_contacts = str_replace("\n", ",", $contacts);
        $x_contacts = str_replace("\r", "", $x_contacts);
        $contact_numbers = explode(",", $x_contacts);
        return $contact_numbers;
    }
}
