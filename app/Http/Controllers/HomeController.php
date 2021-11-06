<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $user = $request->user();

        if($user){
            if ($user->level == '1'){
                return redirect('/admin');
            }else if ($user->level == '2'){
                return redirect('/kasir');
            }
        }else{
            return redirect('/login');
        }
    }
}
