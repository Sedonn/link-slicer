<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    private function getUrlHash(string $url)
    {
        return hash('md5', $url);
    }

    private function getUserLinks()
    {
        return Link::query()->where('added_by', \auth()->user()->login)->get();
    }

    public function redirectToUserLink($key)
    {
        $link = Link::query()->where('key', $key)->first();
        return ($link) ? \redirect($link->url) : \view('pages.404');
    }

    public function createUserLink(Request $request)
    {
        $validated = $request->validate([
            'link' => 'required | url'
        ]);

        $url = $validated['link'];

        (new Link([
            'added_by' => \auth()->user()->login,
            'key' => $this->getUrlHash($url),
            'url' => $url
        ]))->save();

        return \redirect()->route('links');
    }

    public function editUserLink(Request $request)
    {
        $validated = $request->validate([
            'oldLink' => 'required | url',
            'newLink' => 'required | url'
        ]);

        $link = Link::query()->where('url', $validated['oldLink'])->first();
        $link->url = $validated['newLink'];
        $link->key = $this->getUrlHash($validated['newLink']);

        $link->save();

        return $this->showEditLinkPage();
    }

    public function deleteUserLink(Request $request)
    {
        $validated = $request->validate([
            'links' => 'required | array'
        ]);

        Link::query()->whereIn('url', $validated['links'])->delete();

        return $this->showDeleteLinkPage();
    }

    public function showLinksPage()
    {
        return view('pages.links', [
            'links' => $this->getUserLinks()
        ]);
    }

    public function showCreateLinkPage()
    {
        return view('pages.link_create');
    }

    public function showEditLinkPage()
    {
        return view('pages.link_edit', [
            'links' => $this->getUserLinks()
        ]);
    }

    public function showDeleteLinkPage()
    {
        return view('pages.link_delete', [
            'links' => $this->getUserLinks()
        ]);
    }
}
