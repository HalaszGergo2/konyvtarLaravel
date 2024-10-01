<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function store(Request $request)
    {
        $record = new User();
        $record->fill($request->all());
        $record->save();
    }

    public function show(string $id)
    {
        return User::find($id);
    }


    public function update(Request $request, string $id)
    {
        $record = User::find($id);
        $record->fill($request->all());
        $record->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::find($id)->delete();
    }
}
