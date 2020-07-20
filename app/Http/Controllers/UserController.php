<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Request $request)
    {
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (Auth::user()->id == $user->id) {
            return view('users.edit', ['user' => $user]);
        } else {
            return redirect('/')->with('flash', 'Toto nieje Vas profil');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
    public function update_avatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:image,jpeg,png,jpg,gif,svg|max:3000',
        ]);

        $user = Auth::user();
        Storage::deleteDirectory("avatars/user-$user->id");

        $avatarName =  $user->id . '_avatar' . time() . '.' . request()->avatar->getClientOriginalExtension();
        $avatarPath = "avatars/user-$user->id";
        $request->avatar->storeAs("$avatarPath", $avatarName);

        $user->avatar = '/storage/' . $avatarPath . '/' . $avatarName;
        $user->save();

        return back()
            ->with('flash', "Obrazok bol nahrany !");
    }
}
