<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('public.home');
    }

    public function services(): View
    {
        return view('public.services');
    }

    public function membership(): View
    {
        return view('public.membership');
    }

    public function about(): View
    {
        return view('public.about');
    }

    public function contact(): View
    {
        return view('public.contact');
    }

    public function privacy(): View
    {
        return view('public.privacy');
    }

    public function terms(): View
    {
        return view('public.terms');
    }

    public function riskDisclosure(): View
    {
        return view('public.risk-disclosure');
    }
}
