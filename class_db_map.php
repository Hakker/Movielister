<?php

class db_map
{
    public $map;

    public function __construct()
    {
        /**
         * Explanation how the MAP is constructed:
         * Source:
         *
         * <?xml version="1.0" encoding="utf-8"?>
         * <movie>
         *   <title>I Want to be Loved by You. Kaede Fuyutsuki</title>
         * </movie>
         *
         * [
         *   'tablename' => [
         *     'columnname' => [
         *       'content' => 'movie|title'
         *     ]
         *   ]
         * ]
         */
        $this->map = [
            'title' => [
                'title' => 'title',
                'originaltitle' => 'originaltitle',
                'sorttitle' => 'sorttitle',
                'set' => 'set',
                'year' => 'year',
                'top250' => 'top250',
                'trailer' => 'trailer',
                'votes' => 'votes',
                'rating' => 'rating',
                'outline' => 'outline',
                'plot' => 'plot',
                'tagline' => 'tagline',
                'runtime' => 'runtime',
                'releasedate' => 'releasedate',
                'studio' => 'studio',
                'thumb' => 'thumb',
                'fanart' => 'fanart',
                'mpaa' => 'mpaa',
                'movie_id' => 'id',
                'genre' => 'genre',
                'actor' => 'actor',
                'director' => 'director',
                'added' => 'Added'
            ]
        ];
    }
}