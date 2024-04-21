<?php 

namespace App\Services;
use Illuminate\Support\Facades\DB;

class WaService 
{
    private $url;
    private $key;

    public function __construct()
    {
        $this->key = env('WOOWA_KEY');
        $this->url = env('WOOWA_URL');
    }
	
	public static function sendTextMessage($contact, $message)
	{
		DB::beginTransaction();
        try {

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

            $res   = $obj->getCurl($url, $data);

            // save response to table history message
            DB::commit();

            return $res;

        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
		
	}

    public static function generateQrcode()
    {
        DB::beginTransaction();
        try {

            $obj = new self();
            $key= $obj->key;
            $url= $obj->url.'generate_qr';

            $data = array(
                "key"       => $key,
                );
        
            $res   = $obj->getCurl($url, $data);

            DB::commit();
            return $res;

        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
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