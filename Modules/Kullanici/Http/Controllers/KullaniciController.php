<?php

namespace Modules\Kullanici\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use RealRashid\SweetAlert\Facades\Alert;

class KullaniciController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $all = User::with('roles')->get();
        //dd($all);
        return view('kullanici::index',compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {

        $roles = Role::all();
        return view('kullanici::create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $user = new User;

        $user->name         =  $request->name;
        $user->email        =  $request->email;
        $user->telefon        =  $request->telefon;
        $user->depertman    =  $request->depertman;
        $user->password     =  Hash::make($request->password);
        $user->save();

        $user->syncRoles($request->role);

        toast('Success Toast','success');
        return back()->withInput();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('kullanici::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $detay = User::findOrFail($id);
        $roles = Role::all();
        return view('kullanici::edit', compact('detay', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name         =  $request->name;
        $user->email        =  $request->email;
        $user->telefon      =  $request->telefon;
        $user->depertman    =  $request->depertman;
        $user->password     =  Hash::make($request->password);
        $user->save();

        $user->syncRoles($request->role);

        Alert::warning('Warning Title', 'Warning Message');
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    public function active(Request $request)
    {

        dd($request->is_active);
        $update=User::findOrFail($request->id);
        $update->is_active = $request->is_active == "true" ? 1 : 0 ;
        $update->save();
    }
}
