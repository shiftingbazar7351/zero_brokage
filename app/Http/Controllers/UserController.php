<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    function homepage()
    {
        $menu = DB::select('Select * from menus');
        $subcat = DB::select('Select * from sub_categories');
        $cat = DB::select('Select * from categories');
        return view('frontend.index', [
            'menus' => $menu,
            'categories' => $cat,
            'subCategories' => $subcat
        ]);
    }

    function category_demo()
    {

        $cat = DB::select('Select * from categories');
        return view('services.index', [
            'categories' => $cat

        ]);

    }

    function sub_category()
    {
        $user = DB::select('Select * from sub_categories');
        $users = DB::select('Select * from categories');
        return view('sub_category.index', ['subCategories' => $user], ['categories' => $users]);
    }

    function menu()
    {
        $menu = DB::select('Select * from menus');
        $subcat = DB::select('Select * from sub_categories');
        $cat = DB::select('Select * from categories');
        return view('menu.index', [
            'menus' => $menu,
            'categories' => $cat,
            'subCategories' => $subcat
        ]);
    }

    function submenu()
    {
        $menu = DB::select('Select * from submenus');
        $subcat = DB::select('Select * from sub_categories');
        $cat = DB::select('Select * from categories');
        return view('submenu.index', [
            'categories' => $cat,
            'menus' => $menu,
            'subCategories' => $subcat
        ]);
    }


}
