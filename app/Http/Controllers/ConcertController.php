<?php

namespace App\Http\Controllers;

use App\Models\Concert;

class ConcertController extends Controller
{
    public function show($id)
    {
        $concert = Concert::published()->findOrFail($id);
       // dd($concert);
        return view('test', ['concert' => $concert]);
    }
}
