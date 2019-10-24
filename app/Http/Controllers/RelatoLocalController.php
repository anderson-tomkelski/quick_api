<?php

namespace App\Http\Controllers;

use App\RelatoLocal;
use Illuminate\Http\Request;

class RelatoLocalController extends Controller
{

    public function showAllRelatoLocal()
    {
        return response()->json(RelatoLocal::all());
    }
}