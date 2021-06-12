<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;




class Usercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('admin.user.create', compact(['users']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => "required|unique:users|max:255",
            'email' => "required|string|email|max:255|unique:users",
            'image' => 'image.jpg',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // dd($request->all());
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'description' => $request->description,
        ]);


        $user->save();


        // if ($request->hasFile('image')) {
        //     $image =  request()->file('image')->getClientOriginalName();
        //     request()->file('image')->storeAs('public' . '/' . 'users', $user->id . '/' . $image, '');
        //     $user->update(['image' => $image]);
        // }

        return redirect()->route('user.index')->with('success', 'Record created successfully');



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // dd($request->all());
        $request->validate([
            'name' => "required|unique:users,name,$user->id",
            'email' => "required|email|unique:users,email, $user->id",
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->description = $request->description;
        $user->save();
        return redirect()->route('user.index')->with('success', 'Record updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user) {
            if (file_exists(public_path('storage/users/' . $user->id . '/' . $user->image))) {
                unlink(public_path('storage/users/' . $user->id . '/' . $user->image));
            }
            $user->delete();
            return redirect()->back()
                ->with('success', 'Record deleted successfully');
        }
    }

   public function changepassword(Request $request, User $user)
    {

         $request->validate([
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
         $user->password = bcrypt($request->password);
          $user->save();
       return redirect()->back()->with('success', 'Password updated successfully');
    }
     public function changeavatar(Request $request, User $user)
    {

         $request->validate([
         'image' => "required",
        ]);
           $user->delete();
           $user->addMedia($request->image)->toMediaCollection();
           $user->save();

       return redirect()->back()->with('success', 'Image uploaded successfully');

    }
}
