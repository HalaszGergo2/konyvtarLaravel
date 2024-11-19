<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    //alapfüggvények

    public function index()
    {
        return Reservation::all();
    }

    public function store(Request $request)
    {
        $record = new Reservation();
        $record->fill($request->all());
        $record->save();
    }

    public function show(string $user_id, $book_id, $start)
    {
        $reservation = Reservation::where('user_id', $user_id)->where('book_id', $book_id)->where('start', $start)->get();
        return $reservation[0];
    }


    public function update(Request $request, string $user_id, $book_id, $start)
    {
        $record = $this->show($user_id, $book_id, $start);
        $record->fill($request->all());
        $record->save();
    }

    public function destroy($user_id, $book_id, $start)
    {
        $this->show($user_id, $book_id, $start)->delete();
    }

    //spec lekérdezések
    public function reservedBooks(){
        $user = Auth::user(); //bejelentkezett felhasználó
        return Reservation::with('books')
        ->where('user_id','=',$user->id)
        ->get();
    }

    public function reservedCount(){
        $user = Auth::user(); //bejelentkezett felhasználó
        return DB::table("reservations")
        ->where('user_id', $user->id)
        ->count();
    }
}
