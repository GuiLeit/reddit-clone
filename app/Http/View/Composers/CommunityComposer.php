<?php

declare(strict_types=1);

namespace App\Http\View\Composers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

final class CommunityComposer
{
    public function compose(View $view): void
    {
        $showMyCommunities = request()->get('show_my_communities', false);

        $myCommunities = Auth::check()
            ? ($showMyCommunities
                ? Auth::user()->communities()->get()
                : Auth::user()->communities()->limit(10)->get())
            : collect();

        $view->with([
            'myCommunities' => $myCommunities,
            'showMyCommunities' => $showMyCommunities,
        ]);
    }
}
