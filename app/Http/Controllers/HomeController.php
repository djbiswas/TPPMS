<?php

namespace App\Http\Controllers;

use App\Support\Company;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        return view('public.home', [
            'property' => Company::property(),
        ]);
    }
}
