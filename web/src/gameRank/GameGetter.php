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
        // TODO: if too many API requests per second, consider sleeping() between some of the queries
        $ret = [];
        $builder = new IGDBQueryBuilder();
        // This query handles name, summary, storyline, screenshots, cover,
        try {
            $first_query = $this->igdb->game(
                $builder
                ->id($gameID)
                ->fields("name, summary, screenshots.*, cover.*")
                ->build()
            );
            sleep(1);
            // This query handles company name, company logo
            // TODO: not working
            $second_query = $this->igdb->company(
                $builder
                ->id($gameID)
                ->fields("name, logo")
                ->build()
            );
            sleep(1);
            // This query handles platform
            // TODO: not working
            $third_query = $this->igdb->platform(
                $builder
                ->id($gameID)
                ->fields("name")
                ->build()
            );
            sleep(1); // Break up API calls
            // This query handles genre
            // TODO: not working
            $fourth_query = $this->igdb->genre(
                $builder
                ->id($gameID)
                ->fields("name")
                ->build()
            );
            sleep(1);
            // This query handles release date
            $fifth_query = $this->igdb->release_date(
                $builder
                ->id($gameID)
                ->fields("human")
                ->build()
            );
            var_dump($second_query);
            // Plaintext
            $ret["name"] = $first_query[0]->name;
            $ret["company"] = $second_query[0]->company;
            $ret["genre"] = $fourth_query[0]->name;
            $ret["summary"] = $first_query[0]->summary;
            $ret["platform"] = $third_query[0]->name;
            $ret["release_date"] = $fifth_query[0]->human;
            // Images
            $screenshots_array = $first_query[0]->screenshots;
            $ret["cover"] = $first_query[0]->cover->url;
            $ret["company_logo"] = $second_query[0]->logo->url;
            $screenshots = [];
            for ($i = 0; $i < count($screenshots_array); $i++) {
                $screenshots[] = $screenshots_array[$i]->url;
            }
            $ret["screenshots"] = $screenshots;
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
        return $ret;
    }

    public function getImage($imageID, $resolution = "720p") {
        return IGDBUtils::image_url($imageID, $resolution);
    }

}

