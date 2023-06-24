<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use JeroenG\Explorer\Application\Results;
use JeroenG\Explorer\Domain\Aggregations\TermsAggregation;
use JeroenG\Explorer\Infrastructure\Scout\ElasticEngine;

class UserAggregateController extends Controller
{
    public function __invoke(Request $request)
    {
        $search = Item::search();

        /** @var Results $results */
        $results = $search->raw();

        return view('user.aggregations', [
            'aggregations' => $results->aggregations(),
            'query' => ElasticEngine::debug()->json(),
        ]);
    }
}
