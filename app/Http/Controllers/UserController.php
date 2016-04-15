<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Validator;


class UserController extends Controller
{
    public function showProfileForm(Request $request)
    {
        $owner = Auth::user();
        return view('home.user_profile', ['owner' => $owner, 'errors']);
    }

    /**
     * 受け取った情報をもとにユーザー情報を更新する
     */
    public function editProfile(Request $request)
    {
        $profile = $request->only('name');
        $validator = Validator::make($profile, [
            'name' => 'required',
            ]
        );
        if ( $validator->fails() ) {
            $request->session()->flash('flash_message', 'ユーザー情報の更新に失敗しました');
            return $this->showProfileForm($request)->with(['errors' => $validator->errors()]);
        }

        $owner = Auth::user();
        if ( $profile['name'] == $owner->name ) {
            return $this->showProfileForm($request);
        }
        DB::transaction(function () use ($owner, $request, $profile)
        {
            $owner->name = $profile['name'];
            $owner->save();
            $request->session()->flash('flash_message', 'ユーザー情報を更新しました');
        });
        return redirect('/users/_me/profile');
    }
}
