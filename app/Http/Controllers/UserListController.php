<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class UserListController extends Controller
{
    public function __invoke(Request $request)
    {
        $people = Item::search()->orderBy('id', 'desc')->paginate();
        
        return view('user.list', [
            'people' => $people,
        ]);
    }
}
