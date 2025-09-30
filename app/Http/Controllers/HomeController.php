<?php

namespace App\Http\Controllers;

use App\Models\Community;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
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

    public function showAllCommunities(Request $request)
    {
        $showMyCommunities = $request->get('show_my_communities', false);

        $myCommunities = auth()->check()
            ? ($showMyCommunities
                ? auth()->user()->communities()->get()
                : auth()->user()->communities()->limit(10)->get())
            : collect();

        // Paginate communities with 15 entries per page
        $communities = Community::withCount('members')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        // Add display title to each community
        $communities->getCollection()->transform(function ($community) {
            $community->displayTitle = "//c " . $community->subforum . " - " . $community->name;
            return $community;
        });

        return view('community-all', [
            'communities' => $communities,
            'myCommunities' => $myCommunities,
            'showMyCommunities' => $showMyCommunities,
        ]);
    }

    public function showCommunity($subforum, Request $request)
    {
        $community = Community::withCount('members')
            ->where('subforum', $subforum)
            ->firstOrFail();
        $community->displayTitle = "//c " . $community->subforum . " - " . $community->name;

        $showMyCommunities = $request->get('show_my_communities', false);

        // Get communities based on show_my_communities parameter
        $myCommunities = auth()->check()
            ? ($showMyCommunities
                ? auth()->user()->communities()->get()
                : auth()->user()->communities()->limit(10)->get())
            : collect();
        
        $posts = collect();

        return view('community-show', [
            'community' => $community,
            'posts' => $posts,
            'myCommunities' => $myCommunities,
            'showMyCommunities' => $showMyCommunities,
            'userIsMember' => $community->userBelongs(auth()->user()),
            'userIsOwner' => $community->isOwnedBy(auth()->user()),
        ]);
    }
}