<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);

        return view('users.index',[
            'users'=> $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create',[
            'user' => (new User())

        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|string|email|max:255|unique:users,email",
            "password" => "required|string|min:8|confirmed",
            "role" => "required",
            "title" => "required",
            "first_name" => "required|string|max:255",
            "last_name" => "required|string|max:255",
            "gender" => "required",
            "birthday" => "nullable",
            "bio" => "nullable",
            "address_1" => "required|string",
            "address_2" => "nullable",
            "city" => "required|string|max:255",
            "postcode" => "required|string|max:255",
            "county" => "required|string|max:255",
            "phone" => "nullable",
            "mobile" => "required|string|max:255",
            "avatar" => "nullable|image|mimes:jpeg,png,jpg",
        ]);
        // hash the user password
        $validated['password'] = Hash::make($validated['password']);

        // create the user
        $user = (new User())->create($validated);
        // set the success message to the session
        session()->flash('success', 'User ' . $user->name . ' created successfully');

         // check if an avatar exists
         if ($request->has('avatar')) {

            // Save the file and get the path
            $path = $request
                ->file('avatar')
                ->store('avatars/' . $user->id, 'public');

            // update the user avatar
            $user->update([
                'avatar' => $path
            ]);
        }

        // redirect to user page
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|string|email|max:255|unique:users,email,{$user->id}",
            "password" => "required|string|min:8|confirmed",
            "role" => "required",
            "title" => "required",
            "first_name" => "required|string|max:255",
            "last_name" => "required|string|max:255",
            "gender" => "required",
            "birthday" => "nullable",
            "bio" => "nullable",
            "address_1" => "required|string",
            "address_2" => "nullable",
            "city" => "required|string|max:255",
            "postcode" => "required|string|max:255",
            "county" => "required|string|max:255",
            "phone" => "nullable",
            "mobile" => "required|string|max:255",
        ]);


         // remove the password if it's null
         if (is_null($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        // update user object
        $user->update($validated);

          // check if an avatar exists
          if ($request->has('avatar')) {

            // check if the user already has an avatar and remove it
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Save the file and get the path
            $path = $request
                ->file('avatar')
                ->store('avatars/' . $user->id, 'public');

            // update the user avatar
            $user->update([
                'avatar' => $path
            ]);
        }

        //setting success message for the session
        session()->flash('success', 'User details have been updated successfully');



        // redirect to user page
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
          // delete user
          $user->delete();

          // set the success message to the session
          session()->flash('success', 'User deleted successfully');

          // redirect to user page
          return redirect()->route('users.index');
    }
}
