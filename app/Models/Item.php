<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JeroenG\Explorer\Application\Aliased;
use JeroenG\Explorer\Application\BePrepared;
use JeroenG\Explorer\Application\Explored;
use JeroenG\Explorer\Application\IndexSettings;
use JeroenG\Explorer\Domain\Analysis\Analysis;
use JeroenG\Explorer\Domain\Analysis\Analyzer\StandardAnalyzer;
use JeroenG\Explorer\Domain\Analysis\Filter\SynonymFilter;
use Laravel\Scout\Searchable;

class Item extends Model implements Explored, BePrepared, IndexSettings, Aliased
{
    use HasFactory;
    use Searchable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'title',
        'description',
    ];

    protected $perPage = 5;

    public function mappableAs(): array
    {
        return [
            'id' => 'keyword',
            'title' => [
                'type' => 'text',
                'analyzer' => 'synonym',
            ],
            'description' => 'keyword',
        ];
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
        ];
    }
    public function prepare($searchable): array
    {
        if ($searchable['description'] === 'necessitatibus') {
            $searchable['description'] = 'necessitatibus';
        }
         return $searchable;
    }

    public function indexSettings(): array
    {
        $synonymFilter = new SynonymFilter();
        $synonymFilter->setSynonyms(['mona lisa => leonardo']);

        $synonymAnalyzer = new StandardAnalyzer('synonym');
        $synonymAnalyzer->setFilters(['lowercase', $synonymFilter]);

        return (new Analysis())
            ->addAnalyzer($synonymAnalyzer)
            ->addFilter($synonymFilter)
            ->build();
    }
}
