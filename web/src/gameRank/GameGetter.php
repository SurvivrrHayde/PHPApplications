<?php

class GameGetter {

    private $igdb;

    public function __construct() {
        try {
            $IGDBAuth = IGDBUtils::authenticate("jngpgkkx3yv7iyfhgutzk6p9drrjjx", "9la1i41j5s4vxqwdqe74relqf1l4th");
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
        $this->igdb = new IGDB("jngpgkkx3yv7iyfhgutzk6p9drrjjx", $IGDBAuth->access_token);
    }


    /**
     * Queries IGDB for a game based on what the user types (can be incomplete game name)
     * Returns the top 4 (default) games and covers
     */
    public function searchGame($searchText, $numGames = 4) {
        $builder = new IGDBQueryBuilder();
        try {
            $query = $builder
                ->search($searchText)
                ->fields("id, name, cover")
                ->limit($numGames)
                ->offset(10)
                ->build();
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
        $games = $this->igdb->game($query);
        return $games;
    }

    /**
     * For displaying games on the ranking page, given a successful searchGame() query, $obj
     */
    public function getGameAndCover($obj) {
        $ret = [];
        $ret["game"] = $obj->name;
        $ret["img_url"] = IGDBUtils::image_url($obj->cover, "720p");
        return $ret;
    }


    /**
     *
     */
    public function getGameDetail() {

    }



}