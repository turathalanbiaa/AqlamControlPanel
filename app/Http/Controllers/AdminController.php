<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AdminController extends Controller
{

    public function loginForm () {

        if (Cookie::has('remember_token')) {

            return redirect()->route('main');
        }
        return view('login');
    }

    public function login (Request $request) {

        if (Cookie::has('remember_token')) {

            return redirect()->route('main');
        }

        $this->validate($request, array(
            'email' => 'required|email',
            'password' => 'required',
        ));

        $login = Admin::where('email', $request->email)->where('password', md5($request->password))->first();

        if ($login) {

            $remeberToken = md5(uniqid());
            $login->remember_token = $remeberToken;

            try {

                $login->update();

            } catch (\Exception $exception) {

                return redirect()->back()
                    ->with(['message' => 'حصل خطأ ما الرجاء اعادة المحاولة', 'type' => 'danger']);
            }

            session()->put('user_id', $login->id);
            session()->put('remember_token', $remeberToken);

            return redirect()->route('main')->withCookie(\cookie()
                ->forever('remember_token', $remeberToken));
        }

        return back()->with(['message' => 'الرجاء التأكد من اسم المستخدم وكلمة السر', 'type' => 'danger']);
    }

}
