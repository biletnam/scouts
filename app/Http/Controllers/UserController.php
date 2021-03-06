<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Role;
use App\Tak;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('users.index')->with(['users' => User::getPerRole()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param string $type
     * @return \Illuminate\Http\Response
     */
    public function create(string $type)
    {
        $takken = Tak::get();
        return view('users.create')->withTakken($takken);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	    $this->validate($request, [
		    'username'  => 'required|email',
		    'nickname'  => 'required_if:show_nick,1|string',
		    'show_nick' => 'boolean',
		    'active'    => 'boolean',
		    'member_id' => 'required',
		    'tak_id'    => 'required',
	    ]);

	    $input = $request->all();
	    $user = new User($input);
	    $user->save();

	    Session::flash('success', $user->username.' toegevoegd');
	    return redirect()->route('gebruikers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        return view('users.show')->with(['user' => User::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        return view('users.edit')->with([
        	'user' => User::find($id),
	        'takken' => Tak::get(),
			'roles' => Role::get()
        ]);
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
        $this->validate($request, [
        	'username'  => 'required|email',
        	'nickname'  => 'required_if:show_nick,1|string',
        	'show_nick' => 'boolean',
        	'active'    => 'boolean',
        	'tak_id'    => 'required'
        ]);

        $input = $request->all();
        $user = User::find($id);

        $user->username = $input['username'];
        $user->nickname = $input['nickname'];
	    $user->tak_id = $input['tak_id'];

	    if (isset($input['show_nick'])) { $user->show_nick = $input['show_nick']; }
	    if (isset($input['active'])) { $user->show_nick = $input['active']; }

	    $user->save();


	    Session::flash('success', $user->username.' toegevoegd');
	    return redirect()->route('gebruikers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('gebruikers.index');
    }

    public function settings()
    {
    	return view('users.settings');
    }

    public function storeSettings(Request $request)
    {
    	$this->validate($request, [
    		'old_password' => 'required|min:8',
		    'password' => 'min:8|confirmed'
	    ]);

    	$user = Auth::user();
    	$old_password = $request->get('old_password');
    	$password = $request->get('password');

    	$hasher = app('hash');
    	if ($hasher->check($old_password, Auth::user()->getAuthPassword())) {
    		$user->password = bcrypt($password);
    		$user->save();
    		Session::flash('success', 'Wachtwoord succesvol gewijzigd');
    		return redirect()->back();
	    } else {
    		Session::flash('error', 'Password incorrect');
    		return redirect()->back();
	    }
    }

    public function addRole(Request $request) {
        $user = User::find($request->get('user_id'));
        $user->roles()->attach($request->get('role_id'));
        return redirect()->back();
    }

    public function dropRole(Request $request) {
        $user = User::find($request->get('user_id'));
        $user->roles()->detach($request->get('role_id'));
        return redirect()->back();
    }
}
