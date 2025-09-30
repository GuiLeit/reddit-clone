<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Community;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class CommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View|Factory
    {
        $showMyCommunities = $request->get('show_my_communities', false);

        $myCommunities = auth()->check()
            ? ($showMyCommunities
                ? auth()->user()->communities()->get()
                : auth()->user()->communities()->limit(10)->get())
            : collect();

        // Paginate communities with 15 entries per page
        $communities = Community::query()->withCount('members')
            ->with(['members' => function ($query): void {
                // Only load the current user's membership if authenticated
                if (auth()->check()) {
                    $query->where('user_id', auth()->id());
                }
            }])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        // Add display title and membership status to each community
        $communities->getCollection()->transform(function ($community): Community {
            $community->displayTitle = '//c '.$community->subforum.' - '.$community->name;

            // Add membership flags for easy access in the view
            $community->userBelongs = auth()->check() && $community->userBelongs(auth()->user());

            return $community;
        });

        return view('community-all', [
            'communities' => $communities,
            'myCommunities' => $myCommunities,
            'showMyCommunities' => $showMyCommunities,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): void
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): void
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Community $community, Request $request): View|Factory
    {
        $community->loadCount('members');
        $community->displayTitle = '//c '.$community->subforum.' - '.$community->name;

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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): void
    {
        //
    }

    /**
     * Join a community
     */
    public function join(Community $community)
    {
        // $community is automatically resolved by subforum

        if (! auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Check if user is already a member
        if ($community->hasMember($user)) {
            return back()->with('error', 'Você já é membro desta comunidade.');
        }

        // Add user to community
        $community->members()->attach($user->id);

        return back()->with('success', sprintf('Você entrou na comunidade %s com sucesso!', $community->name));
    }

    /**
     * Leave a community
     */
    public function leave(Community $community)
    {
        // $community is automatically resolved by subforum

        if (! auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Check if user is the owner
        if ($community->isOwnedBy($user)) {
            return back()->with('error', 'Você não pode sair de uma comunidade que você criou.');
        }

        // Check if user is a member
        if (! $community->hasMember($user)) {
            return back()->with('error', 'Você não é membro desta comunidade.');
        }

        // Remove user from community
        $community->members()->detach($user->id);

        return back()->with('success', sprintf('Você saiu da comunidade %s com sucesso!', $community->name));
    }
}
