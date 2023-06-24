# laravel-elastic-search
laravel-elastic-search using 
https://github.com/Jeroen-G/explorer-demo 
https://laravel-news.com/explorer 
https://github.com/Jeroen-G/Explorer

Explorer
Latest Version on Packagist

CI

Next-gen Elasticsearch driver for Laravel Scout with the power of Elasticsearch's queries.

Installation
Via Composer

composer require jeroen-g/explorer
You will need the configuration file to define your indexes:

php artisan vendor:publish --tag=explorer.config
Also do not forget to follow the installation instructions for Laravel Scout, and in your Laravel Scout config, set the driver to elastic.

Usage
Be sure to also have a look at the docs to see what is possible! There is also a demo app available that might be insightful.

Configuration
You may either define the mapping for you index in the config file:

return [
    'indexes' => [
        'posts_index' => [
            'properties' => [
                'id' => 'keyword',
                'title' => 'text',
            ],
        ]
    ]
];
Or you may define the model for the index, and the rest will be decided for you:

return [
    'indexes' => [
        \App\Models\Post::class
    ],
];
In the last case you may implement the Explored interface and overwrite the mapping with the mappableAs() function.

Essentially this means that it is up to you whether you like having it all together in the model, or separately in the config file.

Advanced queries
The documentation of Laravel Scout states that "more advanced "where" clauses are not currently supported". Only a simple check for ID is possible besides the standard fuzzy term search:

$posts = Post::search('lorem ipsum')->get();
Explorer expands your possibilities using query builders to write more complex queries.

For example, to get all posts that:

are published
have "lorem" somewhere in the document
have "ipsum" in the title
maybe have a tag "featured", if so boost its score by 2
You could execute this search query:

$posts = Post::search('lorem')
    ->must(new Matching('title', 'ipsum'))
    ->should(new Terms('tags', ['featured'], 2))
    ->filter(new Term('published', true))
    ->get();
Commands
Be sure you have configured your indexes first in config/explorer.php and run the Scout commands.

Searching indexes
php artisan elastic:search "App\Models\Post" lorem
Changelog
Please see the changelog for more information on what has changed recently.

Credits
Jeroen
Vincent
All Contributors

