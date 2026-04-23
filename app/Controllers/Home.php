<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // Memanggil file home.php yang ada di app/Views/
        return view('home');
    }
}
