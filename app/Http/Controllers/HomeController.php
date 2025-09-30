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
        $showMyCommunities = $request->get('show_my_communities', false);

        $myCommunities = auth()->check()
            ? ($showMyCommunities
                ? auth()->user()->communities()->get()
                : auth()->user()->communities()->limit(10)->get())
            : collect();

        return view('home', [
            'myCommunities' => $myCommunities,
            'showMyCommunities' => $showMyCommunities,
        ]);
    }
}
