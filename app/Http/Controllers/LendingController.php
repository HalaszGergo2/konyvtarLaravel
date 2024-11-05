<?php

namespace App\Http\Controllers;

use App\Models\Lending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LendingController extends Controller
{
    //alapfüggvények

    public function index()
    {
        return Lending::all();
    }

    public function store(Request $request)
    {
        $record = new Lending();
        $record->fill($request->all());
        $record->save();
    }

    public function show(string $user_id, $copy_id, $start)
    {
        $lending = Lending::where('user_id', $user_id)->where('copy_id', $copy_id)->where('start', $start)->get();
        return $lending[0];
    }


    public function update(Request $request, string $user_id, $copy_id, $start)
    {
        $record = $this->show($user_id, $copy_id, $start);
        $record->fill($request->all());
        $record->save();
    }

    public function destroy($user_id, $copy_id, $start)
    {
        $this->show($user_id, $copy_id, $start)->delete();
    }

    // lekérdezések

    public function lendingsFilterByUser(){
        $user = Auth::user();	//bejelentkezett felhasználó
        //copies a függvény neve
        return Lending::with('copies')
        ->where('user_id','=',$user->id)
        ->get();
    }

}
