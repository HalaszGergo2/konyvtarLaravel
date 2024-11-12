<?php

namespace App\Http\Controllers;

use App\Models\Lending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function lendingsCount(){
        $user = Auth::user();
        $lendings = DB::table("lendings as l")
        ->where('user_id', $user->id)
        ->count();
        return $lendings;
    }

        //hány könyvet kölcsönöztem?
    public function lendingsCountDistinct(){
        $user = Auth::user();
        $lendings = DB::table("lendings as l")
        ->join('copies as c', 'l.copy_id', '=', 'c.copy_id')
        ->where('user_id', $user->id)
        ->distinct('c.book_id')
        ->count();
        return $lendings;
    }

        //hány példányt van nálam?
        public function activeLendingsCount(){
            $user = Auth::user();
            $lendings = DB::table("lendings as l")
            ->where('user_id', $user->id)
            ->whereNull('end')
            ->count();
            return $lendings;
        }

        //milyen könyvek vannak nálak?
        public function activeLendingsData(){
            $user = Auth::user();
            $lendings = DB::table("lendings as l")
            ->select('b.book_id', 'author', 'title')
            ->join('copies as c', 'l.copy_id', '=', 'c.copy_id')
            ->join('books as b', 'c.book_id', '=', 'b.book_id')
            ->where('user_id', $user->id)
            ->whereNull('end')
            ->groupBy('b.book_id')
            ->get();
            return $lendings;
        }

        public function activeLendingsDataCount(){
            $user = Auth::user();
            $lendings = DB::table("lendings as l")
            ->select( 'b.book_id', 'author', 'title')
            ->join('copies as c', 'l.copy_id', '=', 'c.copy_id')
            ->join('books as b', 'c.book_id', '=', 'b.book_id')
            ->where('user_id', $user->id)
            ->whereNull('end')
            ->groupBy('b.book_id')
            ->having('b.book_id', '=', 1)
            ->get();
            return $lendings;
        }
}
