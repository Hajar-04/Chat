<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $query = $request->get('query');

        if ($query) {
            // Filter users based on search query
            $users = User::where('name', 'LIKE', "%{$query}%")->get();
        } else {
            // Return all users if no query is provided
            $users = User::all();
        }

        return response()->json($users);
    }
    
    public function show($id)
{
    $user = User::findOrFail($id);
    return view('users.profile', compact('user'));
}
}
