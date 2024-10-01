<?php

namespace App\Http\Controllers;

use App\Models\User;
<<<<<<< HEAD
use Illuminate\Console\View\Components\Task;
=======
>>>>>>> 496461b98e2c85c218aece720c04c77cb9668b35
use Illuminate\Http\Request;

class UserController extends Controller
{
<<<<<<< HEAD

=======
    /**
     * Display a listing of the resource.
     */
>>>>>>> 496461b98e2c85c218aece720c04c77cb9668b35
    public function index()
    {
        return User::all();
    }

<<<<<<< HEAD

=======
    /**
     * Store a newly created resource in storage.
     */
>>>>>>> 496461b98e2c85c218aece720c04c77cb9668b35
    public function store(Request $request)
    {
        $record = new User();
        $record->fill($request->all());
        $record->save();
    }

<<<<<<< HEAD

=======
    /**
     * Display the specified resource.
     */
>>>>>>> 496461b98e2c85c218aece720c04c77cb9668b35
    public function show(string $id)
    {
        return User::find($id);
    }

<<<<<<< HEAD

    public function update(Request $request, string $id)
    {
        $record = User::find($id);
        $record->fill($request->all());
        $record->save();
=======
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
>>>>>>> 496461b98e2c85c218aece720c04c77cb9668b35
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
<<<<<<< HEAD
        User::find($id)->delete();
=======
        //
>>>>>>> 496461b98e2c85c218aece720c04c77cb9668b35
    }
}
