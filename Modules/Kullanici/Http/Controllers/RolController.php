<?php

namespace Modules\Kullanici\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolController extends Controller
{

    public function index()
    {
        $all = Role::all();
        return view('kullanici::roller.index',compact('all'));
    }


    public function create()
    {
        $Permission = Permission::all();
        return view('kullanici::roller.create', compact('Permission'));
    }


    public function store(Request $request)
    {

        $rol = new Role;

        $rol->name =$request->name;
        $rol->save();

        $rol->givePermissionTo($request->permission);

        return redirect()->route('roller.index');
    }

    public function show($id)
    {
        return view('kullanici::show');
    }


    public function edit($id)
    {
        $Permission = Permission::all();
        $Detay = Role::findById($id);
        return view('kullanici::roller.edit',compact('Permission', 'Detay'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $rol = Role::findById($id);

        $rol->name =$request->name;
        $rol->save();

        $rol->givePermissionTo($request->permission);

        return redirect()->route('roller.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $sil = Role::find($id);
        $sil->delete();

        return redirect()->route('roller.index');

    }
}
