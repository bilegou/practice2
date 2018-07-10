<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use Auth;
class SessionsController extends Controller
{

   public function __construct(){

   	$this->middleware('guest',[

   		'only'=>['create'],

   	]);

   }


  public function create(){

  		return view('sessions.create');
  }

   public function store(Request $request){
   		

   		$credentials = $this->validate($request,[

  		 'email' => 'required|email|max:255',
         'password' => 'required'

   		]);

   		if(Auth::attempt($credentials,$request->has('remember'))){

   			session()->flash('success','登陆成功!');

   			return redirect()->intended(route('users.show',[Auth::user()]));

   		}else{

			session()->flash('danger', '很抱歉，您的邮箱和密码不匹配');

			return redirect()->back();

   		}


  }

   public function destory(){

   		Auth::logout();
   		session()->flash('success', '退出登陆成功！');
   		return redirect('login');
  	
  }
}
