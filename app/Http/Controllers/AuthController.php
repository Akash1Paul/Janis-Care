<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
 
class AuthController extends Controller
{


  public function login(Request $request)
  {
    $credentials = $request->validate([
      'email' => 'required|email',
      'password' => 'required',
    ]);
   
    if (Auth::attempt($credentials)) {

      $user = User::where('email', $request->email)->get()->toArray();
      $userDetails = UserDetail::where('email', $request->email)->get()->toArray();

      if ($user[0]['roles'] == 'superadmin') {
        $request->session()->regenerate();
        return redirect()->intended('superadmin/dashboard');
      }
       else if ($user[0]['roles'] == 'admin') {
        $request->session()->regenerate();
        return redirect()->intended('admin/users');
      }
       else if ($user[0]['roles'] == 'backoffice') {
        $request->session()->regenerate();
        return redirect()->intended('backoffice/customers');
      } 
      else if ($user[0]['roles'] == 'warehouse') {
        $request->session()->regenerate();
        return redirect()->intended('warehouse/receivedGoods');
      } 
      else if ($user[0]['roles'] == 'relationship' && $userDetails[0]['status'] == 'Approved') {
        $request->session()->regenerate();
        return redirect()->intended('relation/orders');
      }
       else if ($user[0]['roles'] == 'territory' && $userDetails[0]['status'] == 'Approved') {
        $request->session()->regenerate();
        return redirect()->intended('territory/orders');
      }
       else if ($user[0]['roles'] == 'runner' && $userDetails[0]['status'] == 'Approved') {
        $request->session()->regenerate();
        return redirect()->intended('runner/order');
      } 
      else if ($user[0]['roles'] == 'customer') {
        $request->session()->regenerate();
        return redirect()->intended('products');
      } 
      else if ($user[0]['roles'] == 'inventory') {
        $request->session()->regenerate();
        return redirect()->intended('inventory/stocks');
      } 
      else if ($user[0]['roles'] == 'hr') {
        $request->session()->regenerate();
        return redirect()->intended('hr/roles');
      } 
      else {
        return redirect()->back()->withErrors('Please enter valid credentials');
      }
    } else {
      return redirect()->back()->withErrors('Please Enter Correct Email Address & Password');
    }
  }

  // ..........Forget-resetPassword..........
  public function forget_password()
  {
    return view('auth.forget-password');
  }


  public function sendPasswordResetLink(Request $request)
  {
    $request->validate([
      'email' => 'required|email',
    ]);

    $status = Password::sendResetLink($request->only('email'), function ($user, $token) {
      $user->sendPasswordResetNotification($token, now()->addMinutes(10));
    });

    if ($status === Password::RESET_LINK_SENT) {
      return redirect('forget-password')->with('status', 'A password reset link has been sent to your email address.');
    } else {
      return back()->withErrors(['email' => __($status)]);
    }
  }


  public function create(Request $request, $token)
  {
    return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
  }

  public function store(Request $request)
  {
    $request->validate([
      'token' => 'required',
      'email' => 'required|email',
      'password' => 'required|confirmed',
    ]);

    $status = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'), function ($user, $password) {
      $user->forceFill([
        'password' => bcrypt($password),
        'remember_token' => Str::random(60),
      ])->save();
    });

    if ($status === Password::PASSWORD_RESET) {
      return redirect('login')->with('status', 'Your password has been reset!');
    } else {
      return redirect()->back()->withErrors(['email' => __($status)]);
    }
  }
}
