<?php

class db_map
{
    private $map;

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
                'title' => 'movie|title',
                'originaltitle' => 'movie|originaltitle',
                'sorttitle' => 'movie|sorttitle',
                'set' => 'movie|set',
                'year' => 'movie|year',
                'top250' => 'movie|top250',
                'trailer' => 'movie|trailer',
                'votes' => 'movie|votes',
                'rating' => 'movie|rating',
                'outline' => 'movie|outline',
                'plot' => 'movie|plot',
                'tagline' => 'movie|tagline',
                'runtime' => 'movie|runtime',
                'releasedate' => 'movie|releasedate',
                'studio' => 'movie|studio',
                'thumb' => 'movie|thumb',
                'fanart' => 'movie|fanart',
                'mpaa' => 'movie|mpaa',
                'movie_id' => 'movie|id',
                'genre' => 'movie|genre',
                'actor' => 'movie|actor',
                'director' => 'movie|director',
                'added' => 'movie|Added'
            ]
        ];
    }
}