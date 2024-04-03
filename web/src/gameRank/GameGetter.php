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
    public function searchForGamesAndCovers($searchText, $numGames = 10): array {
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
            echo $e->getMessage();
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
     * Queries IGDB for info about the game. Returns an array of info in the format:
     * [name, company, genre, platform, summary, release_date, screenshot_url_array, cover_url, company_logo_url]
     */
    public function getGameDetail($gameID): array {
        $ret = [];
        $builder = new IGDBQueryBuilder();
        try {
            $query = $this->igdb->game(
                $builder
                ->where("id = $gameID")
                ->fields("name, summary, screenshots.url, cover.url, platforms.*, involved_companies.*, genres.name,
                involved_companies.company.name, involved_companies.company.logo.url")
                ->build()
            );
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
        // Simple ones
        $ret["name"] = $query[0]->name;
        $ret["summary"] = $query[0]->summary;
        $ret["cover"] = str_replace("t_thumb", "t_720p", $query[0]->cover->url);
        $screenshots_from_query = $query[0]->screenshots;
        $screenshots = [];
        for ($i = 0; $i < count($screenshots_from_query); $i++) {
            $screenshots[] = str_replace("t_thumb", "t_720p", $screenshots_from_query[$i]->url);
        }
        $ret["screenshots"] = $screenshots;
        // Hard ones
        $genres_from_query = $query[0]->genres;
        $genres = [];
        for ($i = 0; $i < count($genres_from_query); $i++) {
            $genres[] = $genres_from_query[$i]->name;
        }
        $ret["genres"] = $genres;
        $involved_companies_query = $query[0]->involved_companies;
        // Finding developer
        for ($i = 0; $i < count($involved_companies_query); $i++) {
            if ($involved_companies_query[$i]->developer) {
                $company = $involved_companies_query[$i]->company->name;
                $company_logo = str_replace("t_thumb", "t_720p", $involved_companies_query[$i]->company->logo->url);
                break;
            }
        }
        $ret["company"] = $company;
        $ret["company_logo"] = $company_logo;
        // Getting platforms
        $platforms_query = $query[0]->platforms;
        $platforms = [];
        for ($i = 0; $i < count($platforms_query); $i++) {
            $platforms[] = $platforms_query[$i]->name;
        }
        $ret["platforms"] = $platforms;
        return $ret;
    }

    public function getImage($imageID, $resolution = "720p") {
        return IGDBUtils::image_url($imageID, $resolution);
    }

}

