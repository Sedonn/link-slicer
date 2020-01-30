<?php

namespace App\Http\Controllers;

use App\linkModel as linkModel;
use App\UserModel as userModel;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function redirectToUserLink($key)
    {
        $link = linkModel::where('key', $key)->first();
        if ($link) return redirect($link->link);
        else return view('404');
    }
    public function createUserLink(Request $request)
    {
        if ($request->method() == "POST")
        {
            $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $link = $request->input('userLink');
            $link_key = '';
            for($i = 0;$i < 15; $i++)
            {
                $random_char = $chars[mt_rand(0,strlen($chars)-1)];
                $link_key .= $random_char;
            }
            linkModel::insert([
                'added_by'=>$_COOKIE['login'],
                'key' => $link_key,
                'link' => $link
            ]);
            return redirect('/links');
        }
        else
            return view('link_create');
    }
    public function editUserLink()
    {
        return view('link_edit');
    }
    public function getAllUserLinks()
    {
        $links = linkModel::where('added_by',$_COOKIE['login'])->get();
        return view('links_list',['userLinks'=>$links]);
    }
    public function showErrorPage()
    {
        return view('404');
    }
}