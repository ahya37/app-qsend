<?php 

namespace App\Services;

use App\Models\Campaign;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Recipient;

class WaService 
{
    private $url;
    private $key;

    public function __construct()
    {
        $this->key = env('WOOWA_KEY');
        $this->url = env('WOOWA_URL');
    }

    public static function saveCampaign($request, $contacts, $type_message)
    {
        return Campaign::create([
            'id' => Str::random(30),
            'name' => $request->campaign,
            'type' => $type_message,
            'status' => '', // temporary is empty value
            'contacts' => count($contacts),
            'created_by' => Auth::guard('admin')->user()->id
        ]);
    }
	
	public static function sendTextMessage($contact, $message)
	{
        $obj = new self();
        $key= $obj->key;
        $url= $obj->url.'send_message';

        $data = array(
            "phone_no"  => $contact, 
            "key"       => $key,
            "message"   => $message,
            "skip_link" => True, 
            "flag_retry"  => "on",
            "pendingTime" => 3,
            "deliveryFlag" => True,
            );

        $results   = $obj->getCurl($url, $data);

        return $results;
		
	}

    public static function sendMediaMessage($contact, $message, $filename)
	{
        $obj = new self();
        $key= $obj->key;
        $url= $obj->url.'send_image';

        $data = array(
            "phone_no"  => $contact, 
            "key"       => $key,
            "message"   => $message,
            "filename"  => $filename,
            // "skip_link" => True, 
            // "flag_retry"  => "on",
            // "pendingTime" => 3,
            // "deliveryFlag" => True,
            );

        $results   = $obj->getCurl($url, $data);

        return $results;
		
	}

    public static function saveRecipients($request, $data, $image = '', $document = '')
    {
        // save to table recipients

        // Handle if image or document is available


        $x = explode("@", $data['messageId']);
        $xs = explode("_",$x[0]);
        $number = $xs[1];
        
        $recipients = new Recipient();
        $recipients->id = $data['messageId'];
        $recipients->account = '000';
        $recipients->number = '+'.$number;
        $recipients->messages = $request->message;
        $recipients->image = $image;
        $recipients->document = $document;
        $recipients->status = $data['status'];
        $recipients->created_at = $data['sentDate'];
        $recipients->save();

        return $recipients;
    }

    public static function generateQrcode()
    {
        $obj = new self();
        $key= $obj->key;
        $url= $obj->url.'generate_qr';

        $data = array(
            "key"       => $key,
            );
    
        $res   = $obj->getCurl($url, $data);

        DB::commit();
        return $res;
    }

    private function getCurl($url, $data)
    {
        $data_string = json_encode($data);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 360);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
        );

        $res=curl_exec($ch);
        curl_close($ch);

        return $res;
    }
	
}