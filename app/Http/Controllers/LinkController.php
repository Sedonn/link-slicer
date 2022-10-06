<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\User;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    protected Link $link;

    public function __construct(Link $link)
    {
        $this->link = $link;
    }

    private function user(): User
    {
        return \auth()->user();
    }

    private function getUrlHash(string $url): string | false
    {
        return hash('md5', $url);
    }

    public function redirectToUserLink($key)
    {
        $link = $this->link->getLinkByKey($key);
        return ($link) ? \redirect($link->url) : \view('pages.404');
    }

    public function createUserLink(Request $request)
    {
        $request->validate([
            'link' => 'required | url'
        ]);

        $this->user()->links()->create([
            'key' => $this->getUrlHash($request->link),
            'url' => $request->link
        ]);

        return \redirect()->route('links');
    }

    public function editUserLink(Request $request)
    {
        $validated = $request->validate([
            'oldLink' => 'required | url',
            'newLink' => 'required | url'
        ]);

        $this->link->query()
            ->where('url', $validated['oldLink'])
            ->update([
                'key' => $this->getUrlHash($request->newLink),
                'url' => $request->newLink
            ]);

        return $this->showEditLinkPage();
    }

    public function deleteUserLink(Request $request)
    {
        $request->validate([
            'links' => 'required | array'
        ]);

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
