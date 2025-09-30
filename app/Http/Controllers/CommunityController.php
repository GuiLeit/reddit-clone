<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Community;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

final class CommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View|Factory
    {
        // Paginate communities with 15 entries per page
        $communities = Community::query()->withCount('members')
            ->with(['members' => function ($query): void {
                if (Auth::check()) {
                    $query->where('user_id', Auth::id());
                }
            }])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $communities->getCollection()->transform(function ($community): Community {
            $community->displayTitle = '//c '.$community->subforum.' - '.$community->name;
            $community->userBelongs = Auth::check() && $community->userBelongs(Auth::user());
            $community->image = $community->image
                ? (filter_var($community->image, FILTER_VALIDATE_URL) ? $community->image : Storage::url($community->image))
                : null;

            return $community;
        });

        // Preserve query parameters in pagination links
        $communities->appends($request->query());

        return view('community-all', [
            'communities' => $communities,
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
        $community->image = $community->image
            ? (filter_var($community->image, FILTER_VALIDATE_URL) ? $community->image : Storage::url($community->image))
            : null;

        $posts = collect();

        return view('community-show', [
            'community' => $community,
            'posts' => $posts,
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
