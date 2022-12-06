<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\User;
use Illuminate\Support\Str;
class AdminController extends Controller
{
    public function Dashboard(){
        return view('backend.dashboard.index');
    }

    public function getLogin(){
        return view('backend.users.login.login');
    }

    public function submitLogin(Request $request){
        $messsages = array(
            'email.required'=>'Vui lòng nhập email đăng nhập',
            'email.email'=>'Vui lòng nhập email',
            'password.required'=>'Vui lòng nhập password',
        );
        $rules = array(
            'email' => 'required|email',
            'password' => 'required',
        );
        $validator = Validator::make($request->all(), $rules,$messsages);
        if(!$validator->passes()){
            return response()->json(['error'=>$validator->errors()]);
        }else{
            if (Auth::attempt(['email' => $request->email,'password' =>$request->password],true)) {
                return response()->json(['error_check'=>false,'url'=>"/manage/dashboard",'msg'=>"Đăng nhập thành công"]);
            }else{
                return response()->json(['error_check'=>true,'msg'=>"Email hoặc mật khẩu không chính xác"]);
            }
        }
    }

    public function getRegister(){
        return view('backend.users.register.register');
    }

    public function submitRegister(Request $request){
        $messsages = array(
            'name.required'=>'Vui lòng nhập họ tên',
            'email.required'=>'Vui lòng nhập email',
            'phone.required'=>'Vui lòng nhập số điện thoại',
            'password.required'=>'Vui lòng nhập mật khẩu',
            'password.min'=>'Mật khẩu ít nhất 8 ký tự',
            'confirm_password.required'=>'Vui lòng nhập xác nhận mật khẩu',
            'confirm_password.same'=>'Mật khẩu không trùng',
        );
        $rules = array(
            'name'=>'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password'
        );
        $validator = Validator::make($request->all(), $rules,$messsages);
        if(!$validator->passes()){
            return response()->json(['error'=>$validator->errors()]);
        }else{
            $email_check=User::where('email',$request->email)->first();
            $phone_check=User::where('phone',$request->phone)->first();
            if($email_check){
                return response()->json(['error_check'=>true,'msg'=>"Email already exists"]);
            }
            else if($phone_check){
                return response()->json(['error_check'=>true,'msg'=>"Phone already exists"]);
            }else{
                $user= new User();
                $user->name=$request->name;
                $user->email=$request->email;
                $user->phone=$request->phone;
                $user->password=Hash::make($request->password);

                $user->user_hash=Str::random(10);
                $user->save();
                return response()->json(['error_check'=>false,'msg'=>"Đăng ký tài khoản thành công"]);
            }
        }
    }

    public function getLogout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('get.login');
    }
}
