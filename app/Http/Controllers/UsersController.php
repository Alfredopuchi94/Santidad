<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Laracasts\Flash\Flash;
use App\Http\Requests\UserRequest;
use App\Http\Requests\EditUserRequest;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'ASC')->paginate(5);
        return view('admin.users.index')->with('users',$users);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(UserRequest $request)
    {
        $user =new User($request->all());
        $user->password = bcrypt($request->password);

        $user->save();

        Flash::success("Se ah registrado correctamente " . $user->name . " de forma exitosa!");
        return redirect()->route('users.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit')->with('user', $user);
    }

    public function update(EditUserRequest $request, $id)
    {
        $user = User::find($id);
        $user->fill($request->all());
        $user->save();
        flash('El usuario "'. $user->name.'" Se ah editado con exito', 'warning');
        return redirect()->route('users.index');
    }

    public function destroy($id)
    {   
        $user = User::find($id);
        $user->delete();

        Flash::error("El usuario " .$user->name . "a sido borrado de forma exitosa");
        return redirect()->route('users.index');
    }
}
