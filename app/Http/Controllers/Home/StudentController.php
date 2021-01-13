<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use App\Student;
use Auth;
use Flc\Dysms\Client;
use Flc\Dysms\Request\SendSms;
class StudentController extends Controller
{
    public function login(){
        return view('home.student.login');
    }
    public function qqlogin(){
        return Socialite::driver('qq')->redirect();
    }
    public function qqlogin_back(){
        $user=Socialite::driver('qq')->user();
        $qq_id=$user->id;
        $qq_name=$user->name;
        $qqStudent=Student::where('qq_id',$qq_id)->first();
        if($qqStudent===null){
            $data['std_name']=$qq_name;
            $data['std_password']=bcrypt('');
            $data['qq_id']=$qq_id;
            $qqStudent=Student::create($data);
        }else{
            $data['std_name']=$qq_name;
            $qqStudent->update($data);
        }
        Auth::guard('home')->login($qqStudent);
        echo <<<eof
    <script>
        window.opener.location.href='/';
        window.close();
    </script>
eof;

    }
    public function sms(Request $request){
        $config=[
            'accessKeyId'=>'',
            'accessKeySecret'=>'',
        ];
        $mobile=$request->input('number');
        $client=new Client($config);
        $sendSms=new SendSms;
        $sendSms->setPhoneNumbers($mobile);
        $sendSms->setSignName('张梁个人网站');
        $sendSms->setTemplateCode('SMS_91845074');
        $code=rand(100000,999999);
        \Session::put('mobile_code',$code);
        $sendSms->setTemplateParam(['code'=>$code,'time'=>5]);
        $sendSms->setOutId('demo');
        $rst=$client->execute($sendSms);
        if($rst->Message==='ok'){
            return ['success'=>true];
        }else{
            return ['success'=>false];
        }
    }
}
