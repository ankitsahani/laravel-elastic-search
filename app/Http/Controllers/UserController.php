<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserSearchFormRequest;
use App\Models\Item;
use JeroenG\Explorer\Domain\Syntax\Compound\BoolQuery;
use JeroenG\Explorer\Domain\Syntax\Matching;
use JeroenG\Explorer\Domain\Syntax\Nested;
use JeroenG\Explorer\Domain\Syntax\Terms;
use JeroenG\Explorer\Infrastructure\Scout\ElasticEngine;

class UserController extends Controller
{

    public function show()
    {
        $people = Item::get()->take(10);

        return view('user.search', [
            'people' => $people
        ]);
    }

    public function search(UserSearchFormRequest $request)
    {
        $search = Item::search($request->get('keywords'));

        $people = $search->take($request->get('offset'))->get();
       
        return view('user.search', [
            'people' => $people,
            'keywords' => $request->get('keywords') ?? '',
            'query' => ElasticEngine::debug()->json()
        ]);
    }
}
