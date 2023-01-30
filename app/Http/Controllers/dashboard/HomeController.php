<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditUsersRequest;
use App\Http\Requests\NewPasswordRequest;
use App\Http\Requests\UserRequest;
use App\Models\Cities;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::with('cities', 'roles')->get();
        return view('components.dashboard.users.register', ['users' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCities()
    {
        $cities = Cities::where('status', '1')->get();
        return response()->json($cities);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRoles()
    {
        $roles = Roles::where('status', '1')->get();
        return response()->json($roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request, Redirector $redirect)
    {
        $validate = $request->validated();

        $user = new User();
        $user->name           = $request->names;
        $user->last_name      = $request->lastNames;
        $user->email          = $request->email;
        $user->phone          = $request->phone;
        $user->address        = $request->address;
        $user->neightboarhood = $request->neighboardhood;
        $user->sex            = $request->flexRadioGenre;
        $user->image          = $user->flexRadioGenre == 'M' ? 'images/avatar1.jpg' : 'images/avatar2.jpg';
        $user->city_id        = $request->cities;
        $user->role_id        = $request->roles;
        $user->status         = $request->status == null ? '0' : '1';
        $user->password       = Hash::make($request->password);
        $user->save();

        return $redirect->to('users')->with('status', 'Usuario creado con exito');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $user = User::with('cities', 'roles')->where('id', $request->id)->get();
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changePassword(NewPasswordRequest $request)
    {
        $validate = $request->validated();
        User::where('id', $request->userId)->update(['password'  =>  Hash::make($request->passwordNew)]);
        return response()->json('Contraseña Actualizada Exitosamente!!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUsersRequest $request, Redirector $redirect)
    {

        $validate = $request->validated();
        $userUpdate = User::where('id', $request->idUser)
                            ->update([
                                'name'           => $request->names,
                                'last_name'      => $request->lastNames,
                                'email'          => $request->email,
                                'phone'          => $request->phone,
                                'address'        => $request->address,
                                'neightboarhood' => $request->neighboardhood,
                                'sex'            => $request->flexRadioGenre,
                                'city_id'        => $request->cities,
                                'role_id'        => $request->roles,
                                'status'         => $request->status,
                            ]);
        return $redirect->to('users')->with('status', 'Usuario actualizado con exito');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Redirector $redirect)
    {
        $deleteUSer = User::where('id', $request->id)->update(['status' => '0']);
        return $redirect->to('users')->with(['status'  =>  'Usuario Eliminado']);
    }



    public function getProfileData()
    {
        $id = Auth::user()->id;
        $user = User::where('users.id', $id)->with('cities', 'roles')->get();
        return response()->json($user);
    }
}
