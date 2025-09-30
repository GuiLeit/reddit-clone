<?php

declare(strict_types=1);

namespace App\Http\View\Composers;

use App\Models\Community;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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

        $myCommunities->transform(function ($community): Community {
            $community->image = $community->image
                ? (filter_var($community->image, FILTER_VALIDATE_URL) ? $community->image : Storage::disk('public')->url($community->image))
                : null;

            return $community;
        });

        $view->with([
            'myCommunities' => $myCommunities,
            'showMyCommunities' => $showMyCommunities,
        ]);
    }
}
