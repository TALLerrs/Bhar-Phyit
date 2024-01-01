<?php

namespace Tallerrs\BharPhyit\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BharPhyitController extends Controller
{
    /**
     * @param Request $request
     */
    public function index(Request $request)
    {
        dd('http://filament.test/bhar-phyit');
    }

    /**
     * @param Request $request
     */
    public function show(Request $request)
    {
    }
}
