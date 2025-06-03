<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Setting;
use Session;


class isLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next 
     * @return mixed
     */
    public function handle($request, Closure $next)
    { 
        
        
      
       
        $loginWithOtp = Setting::first();
          $ignoreRoutes = [
            'is-Login',
            'sendWhatsapp',
            'validateOtpWhatsapp'
        ];
        if($loginWithOtp->loginWithOtp == 'Yes' && session()->get('role_id') != 1 )
        {
            
            
             if(session()->get('otp_request') != 'accepted' && session()->get('id') != '' )
             {
                if (!in_array($request->path(), $ignoreRoutes)) {
                 
              return redirect()->route('access.denied');
                }
                 
             }
              // return redirect('logout');
            
        }
       
     
        if(session()->get('id') != '' && session()->get('softwareTokenStatus') == 1){
                
        }else{
            
          return redirect()->intended('login');
        }
        
        return $next($request);
    }
}

