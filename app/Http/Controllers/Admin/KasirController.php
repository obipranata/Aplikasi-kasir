<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class KasirController extends Controller
{
    public function index(){
        $data['kasir'] = DB::select("SELECT * FROM users WHERE level = '2' ");
        return view('pages.admin.kasir.index',$data);
    }

    public function create(Request $request){
        return view('pages.admin.kasir.create');
    }

    public function store(Request $request){
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => password_hash($request->password, PASSWORD_DEFAULT),
            'level' => 2
        ];

        User::create($data);

        return redirect('/admin/kasir');
    }

    public function edit($id){
        $data['kasir'] = DB::table('users')->where(['id' => $id])->first();
        return view('pages.admin.kasir.edit', $data);
    }

    public function update(Request $request, $id){
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;

        // dd($email);

        if(isset($_POST['submit'])){
            if (empty($password)){
                $data = [
                    'name' => $name,
                    'email' => $email
                ];
            }else{
                $data = [
                    'name' => $name,
                    'email' => $email,
                    'password' => password_hash($password, PASSWORD_DEFAULT)
                ];
            }

            DB::table('users')->where('id', $id)->update($data);
        }

        return redirect('/admin/kasir');
    }

    public function destroy($id){
        User::where('id', $id)->delete();

        return redirect('/admin/kasir');
    }
}
