<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class HomeController extends Controller
{
    public function index(Request $request): Factory|View
    {
        // The CommunityComposer will automatically provide $myCommunities and $showMyCommunities
        return view('home');
    }
}
