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
     * Returns the top $numGames games and covers as an array in the form:
     * [id, name, coverURL]
     */
    public function searchForGamesAndCovers($searchText, $numGames = 4): array {
        $ret = [];
        $builder = new IGDBQueryBuilder();
        try {
            $query = $this->igdb->game(
                $builder
                ->fields("id, name, cover.*")
                ->search($searchText)
                ->limit($numGames)
                ->offset(10)
                ->build()
            );
        }
        catch (Exception $e) {
            $e->getMessage();
        }
        for ($i = 0; $i < $numGames; $i++) {
            $item = $query[$i];
            $toConcat = [];
            $toConcat[] = $item->id;
            $toConcat[] = $item->name;
            if (isset($item->cover) && is_object($item->cover)) {
                $image_id = $item->cover->image_id;
                $url = IGDBUtils::image_url($image_id, "720p");
            }
            else {
                $url = "";
            }
            $toConcat[] = $url;
            $ret[] = $toConcat;
        }
        return $ret;
    }


    /**
     *
     */
    public function getGameDetail() {

    }



}