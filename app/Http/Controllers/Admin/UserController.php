<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users= User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $questions= $user->question;

        return view('admin.users.show', compact('user', 'questions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
            \DB::rollback();
            abort(500);
        }
        \Session::flash('success', 'プロフィールを更新しました');
         return redirect(route('users.show', $id));
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $user = User::destroy($request->id);
        }catch(\Throwable $e){
            abort(500);
        }
        return redirect()->route('admin.users.index');

    }

}
