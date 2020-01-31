<?php

namespace App\Http\Controllers;

use App\linkModel as linkModel;
use App\UserModel as userModel;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function regenLink()
    {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $link_key = '';
        $condtForAddLink = FALSE;
        while(!$condtForAddLink)
        {
            for($i = 0;$i < 15; $i++)
            {
                $random_char = $chars[mt_rand(0,strlen($chars)-1)];
                $link_key .= $random_char;
            }
            $existLink = linkModel::where('key', $link_key)->first();
            if($existLink) 
                $link_key = '';
            else
                $condtForAddLink = TRUE;
        }
        return $link_key;
    }
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
            $link = $request->input('userLink');
            linkModel::insert([
                'added_by'=>$_COOKIE['login'],
                'key' => regenLink(),
                'link' => $link
            ]);
            return redirect('/links');
        }
        else
            return view('link_create');
    }
    public function editUserLink(Request $request)
    {
        if($request->method() == "POST")
        {
            $userLink = $request->input('userLink');
            $newUserLink = $request->input('newUserLink');
            if(!$newUserLink)
                $newUserLink = $userLink;
            $condtForChangeLink = $request->input('condtForChangeKey');
            if($condtForChangeLink)
            {
                linkModel::where('link', $userLink)->update([
                    'link'=>$newUserLink,
                    'key'=>self::regenLink()
                ]);
            }
            else
            {
                linkModel::where('link', $userLink)->update([
                    'link'=>$newUserLink
                ]);
            }
            return redirect('/links');
        }
        else
        {
            $links = linkModel::where('added_by',$_COOKIE['login'])->get();
            return view('link_edit',['userLinks'=>$links]);
        }
            
    }
    public function deleteUserLink(Request $request)
    {
        if($request->method()=='POST')
        {
            //"userLink":["https:\/\/github.com\/Sedonn\/linksliser","https:\/\/www.php.net\/"]}
            $userLinks = $request->input('userLink');
            foreach($userLinks as $userLink)
                linkModel::where('link',$userLink)->delete();
            return redirect('/links');
        }
        else
        {
            $links = linkModel::where('added_by',$_COOKIE['login'])->get();
            return view('link_delete',['userLinks'=>$links]);
        }
            
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