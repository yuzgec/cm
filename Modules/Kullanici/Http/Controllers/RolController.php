<?php

namespace Modules\Kullanici\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $all = Role::all();
        return view('kullanici::roller.index',compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $Permission = Permission::all();
        return view('kullanici::roller.create', compact('Permission'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {

        $rol = new Role;

        $rol->name =$request->name;
        $rol->save();

        $rol->givePermissionTo($request->permission);

        return redirect()->route('roller.index');
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
