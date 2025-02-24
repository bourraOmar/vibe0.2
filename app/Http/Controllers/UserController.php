<?php 
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


Class UserController extends Controller{
    public static function getAllUsers(){
        $listusers = User::all();
        return view('users', compact('listusers'));
    }

    public function search(Request $request){
        $query = request()->term;

        $listusers = User::where('username', 'LIKE', "%{$query}%")
        ->orWhere('fullname', 'LIKE', "%{$query}%")
        ->get();

        return view('/users', compact('listusers'));
    }
}