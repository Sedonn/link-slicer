<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\User;
use App\Http\Requests\Link\DeleteLinkRequest;
use App\Http\Requests\Link\UpdateLinkRequest;
use App\Http\Requests\Link\StoreLinkRequest;

/**
 * Contoller for operations with the Link model.
 */
class LinkController extends Controller
{
    protected Link $link;

    public function __construct(Link $link)
    {
        $this->link = $link;
    }

    /**
     * Get the current authenticated user.
     *
     * @return User
     */
    private function user(): User
    {
        return auth()->user();
    }

    /**
     * Redirect to added by user url or get the 404 page.
     *
     * @param string $key
     * @return void
     */
    public function redirectToUserLink(string $key)
    {
        $link = $this->link->getLinkByKey($key);
        return ($link) ? redirect($link->url) : view('errors.404');
    }

    /**
     * Add a new link by current user.
     *
     * @param StoreLinkRequest $request
     * @return void
     */
    public function store(StoreLinkRequest $request)
    {
        $this->user()->links()->create($request->validated());

        return redirect()->route('links');
    }

    /**
     * Update a one of existed user links.
     *
     * @param UpdateLinkRequest $request
     * @return void
     */
    public function update(UpdateLinkRequest $request)
    {
        $this->link->query()
            ->where('url', $request->oldUrl)
            ->update($request->only('url'));

        return $this->showEditLinkPage();
    }

    /**
     * Delete a one or many of existed user links.
     *
     * @param DeleteLinkRequest $request
     * @return void
     */
    public function delete(DeleteLinkRequest $request)
    {
        $this->link->query()->whereIn('url', $request->links)->delete();

        return $this->showDeleteLinkPage();
    }

    /**
     * Render the links page.
     *
     * @return void
     */
    public function showLinksPage()
    {
        return view('pages.links', [
            'links' => $this->user()->links
        ]);
    }

    /**
     * Render the create link page.
     *
     * @return void
     */
    public function showCreateLinkPage()
    {
        return view('pages.link_create');
    }

    /**
     * Render the update link page.
     *
     * @return void
     */
    public function showEditLinkPage()
    {
        return view('pages.link_edit', [
            'links' => $this->user()->links
        ]);
    }

    /**
     * Render the detele link page.
     *
     * @return void
     */
    public function showDeleteLinkPage()
    {
        return view('pages.link_delete', [
            'links' => $this->user()->links
        ]);
    }
}
