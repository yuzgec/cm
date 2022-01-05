<?php

namespace Modules\Kullanici\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\User;
Use Alert;
use Hash;
use DB;

class KullaniciController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        if (request()->filled('q'))
        {
            request()->flash();
            $aranan = request('q');
            $all = User::with('roles')->where('name', 'like', "%$aranan%")
                ->orWhere('telefon','like', "%$aranan%")
                ->orderBy('id', 'DESC')
                ->get();

        } else {

            $all = User::with('roles')->get();

        }
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
        $user->telefon      =  $request->telefon;
        $user->durum        =  $request->durum;
        $user->depertman    =  $request->depertman;
        if ($request->password){
            $user->password     =  Hash::make($request->password);
        }

        $user->save();

        $user->addMedia($request->profil_foto)->toMediaCollection();

        $user->syncRoles($request->role);

        toast('eklendi.','success');
        return redirect()->route('kullanici.index');
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
        $user->durum        =  $request->durum;
        $user->depertman    =  $request->depertman;
        if ($request->password){
            $user->password     =  Hash::make($request->password);
        }
        $user->save();

        $user->addMedia($request->profil_foto)->toMediaCollection();

        $user->syncRoles($request->role);

        alert()->success('SuccessAlert','Lorem ipsum dolor sit amet.');

        return redirect()->route('kullanici.index');
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
