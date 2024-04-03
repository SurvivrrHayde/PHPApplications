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
                ->build()
            );
        }
        catch (Exception $e) {
            $e->getMessage();
        }
        var_dump($query);
        for ($i = 0; $i < $numGames; $i++) {
            $toConcat = [];
            $toConcat[] = $query[$i]->id;
            $toConcat[] = $query[$i]->name;
            if (isset($query[$i]->cover) && is_object($query[$i]->cover)) {
                $strToModify = $query[$i]->cover->url;
                $newStr = str_replace("t_thumb", "t_720p", $strToModify);
                $toConcat[] = $newStr;
            }
            else {
                $toConcat[] = "";
            }
            $ret[] = $toConcat;
        }
        return $ret;
    }

    public function getGameIDs($searchText, $numGames = 4): array {
        $ret = [];
        $builder = new IGDBQueryBuilder();
        try {
            $query = $this->igdb->game(
                $builder
                ->search($searchText)
                ->fields("name, id, cover.*")
                ->limit(1)
                ->build()
            );
        }
        catch (Exception $e) {
            $e->getMessage();
        }
        var_dump($query);
        return $ret;
    }



    /**
     *
     */
    public function getGameDetail() {

    }



}