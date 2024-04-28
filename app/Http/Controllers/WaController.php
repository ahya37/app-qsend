<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Services\WaService;
use Illuminate\Support\Facades\DB;

class WaController extends Controller
{
   
    public function textMessage()
    {
        $data = [
            'title' => 'Text Message'
        ];

        return view('whatsapp.textmessage', $data);
    }

    public function mediaMessage()
    {
        $data = [
            'title' => 'Media Message'
        ];

        return view('whatsapp.mediamessage', $data);
    }

    public function mediaMessageStore(MessageRequest $request)
    {
        DB::beginTransaction();
        try {

            // Upload Image to application, return image name
            $image = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/whatsapp/images/', $fileName);
            $filePath = storage_path('app/public/whatsapp/images/'.$fileName);

            //Up image to API Wa
            $res_send_image =  WaService::uploadImage($filePath);

            if($res_send_image == 'success'){
                $request_contacts = $request->validated();
                $request_contacts = $this->numberFormatter($request_contacts['contacts']);
    
                $type_message     = 'media';
                WaService::saveCampaign($request, $request_contacts, $type_message);
                    
                $response = [];
                foreach ($request_contacts as $contact) {
                    $results =  WaService::sendMediaMessage($contact, $request->message, $fileName);
                    $results = json_decode($results, true);
                    $response[] = [$results['message']];
    
                }

                // save to table recipients
                foreach ($response as  $value) {
                        WaService::saveRecipients($request, $value[0], $filePath);
                }
                
                DB::commit();
                return redirect()->route('mediamesage.create')->with(['success' => 'Message sent successfuly']);

            }else{
                return redirect()->route('mediamesage.create')->with(['error' => 'Message failed to send']);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            // return $e->getMessage();
            return redirect()->route('mediamesage.create')->with(['error' => 'Message failed to send']);
        }

    }

    public function textMessageStore(MessageRequest $request)
    {
        DB::beginTransaction();
        try {

            $request_contacts = $request->validated();
            $request_contacts = $this->numberFormatter($request_contacts['contacts']);

            $type_message     = 'text';
            WaService::saveCampaign($request, $request_contacts, $type_message);
            
            $response = [];
            foreach ($request_contacts as $contact) {
                $results =  WaService::sendTextMessage($contact, $request->message);
                $results = json_decode($results, true);
                $response[] = [$results['message']];

            }

            // save to table recipients
            foreach ($response as  $value) {
                    WaService::saveRecipients($request, $value[0]);
            }
            
            DB::commit();
            return redirect()->route('message.create')->with(['success' => 'Message sent successfuly']);

        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }

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
