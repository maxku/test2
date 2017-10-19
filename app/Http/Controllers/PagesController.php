<?php

namespace App\Http\Controllers;


class PagesController extends Controller
{

    // Tree
    public function index()
    {
        return view('index');
    }

    public function find()
    {
        return view('find');
    }
}
