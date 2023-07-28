<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Base\Admin\AdminController;
use App\Http\Controllers\Controller;
use App\Models\Birthday;
use Illuminate\Http\Request;

class BirthdayController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Birthday::get();
        return view('admin.birthday.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.birthday.create');
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
            'name' => 'required',
            'birthday_date' => 'required',
            'description' => 'required'

        ]);

        $data = $request->all();

        $user = new Birthday();
        $user->fill($data);
        $user->save();
        $this->success($this->created, 'Birthdate');
        return redirect('admin/birthday-management');
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
    public function edit($id)
    {
        $data = Birthday::findorFail($id);
        return view('admin.birthday.edit', compact('data'));
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
            'name' => 'required',
            'birthday_date' => 'required',
            'description' => 'required'

        ]);
        $data = $request->all();
        $data = $request->except('_token', '_method');
        $update = Birthday::where('id', $id)->update($data);
        $this->success($this->updated, 'Birthdate');
        return redirect('admin/birthday-management');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $delete = Birthday::where('id', $id)->delete();
        $this->error($this->deleted, 'Birthdate');
        return redirect('admin/birthday-management');
    }
}
