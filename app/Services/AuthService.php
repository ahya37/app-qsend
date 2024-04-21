<?php 

namespace App\Services;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\TokenManagement;

class AuthService 
{
	
	public static function login($request)
	{
		DB::beginTransaction();
        try {
           
			$auth = $request->only('email','password');
			
			$user = User::where('email', $request->email);
			$checkAdmin = $user->count(); 
			
			if($checkAdmin == 0) return redirect()->back()->with(['error' => 'Email / Password Salah']); 
			
			#proses authentication
			if (auth()->guard('admin')->attempt($auth)) {
				
				DB::commit();

				return redirect()->intended(route('dashboard'));
				
			}else{

				return redirect()->back()->with(['error' => 'Email / Password Salah']);
			}
		   
        } catch (\Exception $e) {
			DB::rollback();
            return $e->getMessage();
        }
		
	}
	
	public static function logout()
	{
		$auth = auth()->guard('admin');

        #logout
        $auth->logout();
        return redirect('/');
	}
	
}