<?php

namespace App\Http\Controllers;

use App\linkModel as linkModel;

class LinkController extends Controller
{
    public function redirectToUserLink($key)
    {
        $link = linkModel::where('key', $key)->first();
        if ($link) return redirect($link->link);
        else return view('404');
    }
    public function createUserLink()
    {
        return view('link_create');
    }
    public function editUserLink($linkId)
    {
        return view('link_edit');
    }
    public function getAllUserLinks()
    {
        return view('links_list');
    }
    public function showErrorPage()
    {
        return view('404');
    }
}