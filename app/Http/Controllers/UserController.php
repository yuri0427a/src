<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function show(Request $request, $id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validator =$request->validate([
            'name' => 'required|string|max:50',
            // 'email' => [
            //   'required',
            //   'string',
            //   'max:256',
            //   Rule::unique('users', 'email')->ignore('id')->where('exist', 1),
            // ],
            'introduction' => 'nullable|string|max:200',
        ]);

        $inputs = $request -> all();

        \DB::beginTransaction();
        try{
            $user = User::find($inputs['id']);
            $user ->fill([
                'name' => $inputs['name'],
                'email' => $inputs['email'],
                'introduction' => $inputs['introduction'],
            ]);
            $user->save();
            \DB::commit();
        } catch(\Throwable $e){
            // \DB::rollback();
            // abort(500);
        }
        \Session::flash('success', 'プロフィールを更新しました');
         return redirect(route('users.show', $id));
        }
}
