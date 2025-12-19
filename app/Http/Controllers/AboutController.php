<?php

namespace App\Http\Controllers;

use App\Models\User;

class AboutController extends Controller
{
    public function index()
    {
        $team_members = User::query()->active()->get();

        return view('pages.public.about.index', compact('team_members'));

    }
}
