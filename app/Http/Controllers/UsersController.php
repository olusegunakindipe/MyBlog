<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Profile;
use Session;
use App\Http\Requests\CreateUserRequest;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index')->with('users', User::all())
                                        ->with('profile', Profile::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $user = User::create([
            'name'=> $request->name,
            'email' => $request->email,
            'password'=> bcrypt('password')

        ]);

       $profile = Profile::create([
            'user_id' => $user->id,
            'avatar' => 'uploads/avatars/pics.jpg'
        ]);
        $user->save();
        Session::flash('success', 'The user has been saved successfully');

        return redirect(route('user.index'));
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
        
        return view('admin.users.create')->with('user',$user)->with('profile', Profile::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateUserRequest $request)
    {
        $user = Auth::user();
       
        if($request->hasFile('avatar')){ 
        
            $avatar = $request->avatar; //assign the file to a variable

            $avatar_new = time() . $avatar->getClientOriginalName(); //assign a new name 
            
            $avatar->move('uploads/avatars', $avatar_new); // move the file  with the new name to the directory

            $user->profile->avatar = 'uploads/avatars/'.$avatar_new;

            $user->profile->save();
        }
        $user->name = $request->name;
        $user->email = $request ->email;
        $user->profile->facebook = $request->facebook;
        $user->profile->youtube = $request->youtube;
        $user->profile->about = $request->about;        

        if($request->has('password')){
            $user->password = bcrypt($request->password);
        }
         
        $user->save();
        $user->profile->save();
        
        Session::flash('success', 'The profile has been updated');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        Session::flash('success', 'User successfully Trahed, Go to Trashed Users to restore');
        return redirect(route('user.index'));
    }

    public function trashed()
    {   
        $user = User::onlyTrashed()->get();
        
        return view('admin.users.trashed')->with('users', $user);
    }
    
    public function kill($id)
    {
        $user = User::withTrashed()->where('id', $id)->first();
        $user->forceDelete();

        Session::flash('success', 'The user has been deleted permanently');
        return redirect()->back();
    }

    public function restore($id)
    {
        $user = User::withTrashed()->where('id', $id)->first();
        $user->restore();

        Session::flash('success', 'The user has been restored');
        return redirect()->back(); 
    }

    public function admin(User $user)
    {
       $user->admin = 1;
       $user->save();

       Session::flash('success', 'This user has been made admin');

       return redirect(route('user.index'));
    }
    public function notAdmin(User $user)
    {
       $user->admin = 0;
       $user->save();

       Session::flash('success', 'This user has been removed as an admin');

       return redirect(route('user.index'));
    }
}
