<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
//       $users = User::all();
// //デバッグ用
// // $sql = User::toSql();
// // echo "<pre>\n";var_dump($sql,$users);

//     dd($users);

//       return view('top', ['users' => $users]);
    }
}
