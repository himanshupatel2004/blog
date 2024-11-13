<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserValidate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (!Auth::user()) {
            return redirect('/');
        }
        // $users = User::all();
        $search = $request->search;
        // dd($search);
        $users = User::paginate(5);
        if ($search) {
            $users = User::where('first_name', 'LIKE', '%' . $search . '%')
            ->orwhere('last_name', 'LIKE', '%' . $search . '%')
                ->orwhere('email', 'LIKE', '%' . $search . '%')
                ->orwhere('phone', 'LIKE', '%' . $search . '%')
                ->orwhere('gender', 'LIKE', '%' . $search . '%')
                ->paginate(10);
        }
        // dd($users->toArray());
        return view('user.list', compact('users', 'search'));
    }
    public function search(Request $request)
    {
        $search = $request->search;
        $users = User::paginate(50);
        if ($search != '') {
            $users = User::where('first_name', 'LIKE', '%' . $search . '%')
                ->orwhere('last_name', 'LIKE', '%' . $search . '%')
                ->orwhere('email', 'LIKE', '%' . $search . '%')
                ->orwhere('phone', 'LIKE', '%' . $search . '%')
                ->orwhere('gender', 'LIKE', '%' . $search . '%')
                ->paginate(10);
        }
        return view('user-list', compact('users'));
        // dd($request->all(), "Search");
    }
    public function create()
    {
        return view('user-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserValidate $request)
    {
        if (!Auth::user()) {
            return redirect('/');
        }
        // dd("ss");
        $password = Hash::make($request->password);
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imgName = time() . rand(100000, 999999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imgName);
                $imagePaths[] = 'images/' . $imgName;
            }
        }
        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = $password;
        $user->phone = $request->phone;
        $user->city = $request->city;
        $user->image = !empty($imagePaths) ? json_encode($imagePaths) : null;
        $user->gender = $request->gender;
        $user->save();
        return redirect('user/list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        if (!Auth::user()) {
            return redirect('/');
        }
        $user = User::find($id);
        return view('user-edit', compact('user'));
    }

    public function view($id)
    {
        if (!Auth::user()) {
            return redirect('/');
        }
        $user = User::find($id);
        return view('user-view', compact('user'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!Auth::user()) {
            return redirect('/');
        }
        $id = $request->id;
        $user = User::find($id);

        if ($request->hasFile('images')) {
            $images = json_decode($user->image, true);
            if ($images && is_array($images)) {
                foreach ($images as $image) {
                    if (file_exists(public_path($image))) {
                        unlink(public_path($image));
                    }
                }
            }
            foreach ($request->file('images') as $image) {
                $imgName = time() . rand(100000, 999999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imgName);
                $imagePaths[] = 'images/' . $imgName;
            }
        }
        // dd($request->all());
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->city = $request->city;
        $user->image = !empty($imagePaths) ? json_encode($imagePaths) : $user->image;
        $user->gender = $request->gender;
        $user->save();
        return redirect('user/list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        if (!Auth::user()) {
            return redirect('/');
        }
        $user = User::find($id);
        $images = json_decode($user->image, true);
        foreach ($images as $image) {
            if (file_exists(public_path($image))) {
                unlink(public_path($image));
            }
        }
        $user->delete();
        return redirect('user/list');
    }

    public function show($id)
    {
        if (!Auth::user()) {
            return redirect('/');
        }
        $user = User::find($id);
        return view('user.show', compact('user'));
    }
}