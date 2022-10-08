<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\User;
use App\Http\Requests\Link\DeleteLinkRequest;
use App\Http\Requests\Link\UpdateLinkRequest;
use App\Http\Requests\Link\StoreLinkRequest;

class LinkController extends Controller
{
    protected Link $link;

    public function __construct(Link $link)
    {
        $this->link = $link;
    }

    private function user(): User
    {
        return auth()->user();
    }

    public function redirectToUserLink($key)
    {
        $link = $this->link->getLinkByKey($key);
        return ($link) ? redirect($link->url) : view('pages.404');
    }

    public function store(StoreLinkRequest $request)
    {
        $this->user()->links()->create($request->validated());

        return redirect()->route('links');
    }

    public function update(UpdateLinkRequest $request)
    {
        $this->link->query()
            ->where('url', $request->oldUrl)
            ->update($request->only('url'));

        return $this->showEditLinkPage();
    }

    public function delete(DeleteLinkRequest $request)
    {
        $this->link->query()->whereIn('url', $request->links)->delete();

        return $this->showDeleteLinkPage();
    }

    public function showLinksPage()
    {
        return view('pages.links', [
            'links' => $this->user()->links
        ]);
    }

    public function showCreateLinkPage()
    {
        return view('pages.link_create');
    }

    public function showEditLinkPage()
    {
        return view('pages.link_edit', [
            'links' => $this->user()->links
        ]);
    }

    public function showDeleteLinkPage()
    {
        return view('pages.link_delete', [
            'links' => $this->user()->links
        ]);
    }
}
