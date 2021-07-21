<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(Request $request, $id)
  {
    $user = User::find($id);
    return view('users.show', compact('user'));
  }

}
