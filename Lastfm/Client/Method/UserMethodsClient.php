<?php

namespace BinaryThinking\LastfmBundle\Lastfm\Client\Method;

use BinaryThinking\LastfmBundle\Lastfm\Client\LastfmAPIClient;
use BinaryThinking\LastfmBundle\Lastfm\Model as LastfmModel;

/**
 * UserMethodsClient
 *
 * @author Karol Sójko <karolsojko@gmail.com>
 */
class UserMethodsClient extends LastfmAPIClient
{

    /**
     * Get the top artists tagged by this user, ordered by play count.
     *
     * @param string $user the user name
     * @param string $period the time period over which to retrieve top artists for
     * @param int $limit the number of results to fetch per page. Defaults to 50
     * @param int $page the page number to fetch. Defaults to first page
     */
    public function getTopArtists($user, $period = null, $limit = null, $page = null)
    {
        $response = $this->call(array(
            'method' => 'user.getTopArtists',
            'user' => $user,
            'period' => $period,
            'limit' => $limit,
            'page' => $page
        ));

        $artists = array();
        if (!empty($response->topartists->artist)) {
            foreach ($response->topartists->artist as $artist) {
                $artists[(int)$artist->attributes()->rank] = LastfmModel\Artist::createFromResponse($artist);
            }
        }

        return $artists;
    }

    /**
     * Get the top albums tagged by this user, ordered by play count.
     *
     * @param string $user the user name
     * @param string $period the time period over which to retrieve top artists for
     * @param int $limit the number of results to fetch per page. Defaults to 50
     * @param int $page the page number to fetch. Defaults to first page
     */
    public function getTopAlbums($user, $period = null, $limit = null, $page = null)
    {
        $response = $this->call(array(
            'method' => 'user.getTopAlbums',
            'user' => $user,
            'period' => $period,
            'limit' => $limit,
            'page' => $page
        ));

        $albums = array();
        if (!empty($response->topalbums->album)) {
            foreach ($response->topalbums->album as $album) {
                $albums[(int)$album->attributes()->rank] = LastfmModel\Album::createFromResponse($album);
            }
        }

        return $albums;
    }

    /**
     * Get the top tracks tagged by this user, ordered by play count.
     *
     * @param string $user the user name
     * @param string $period the time period over which to retrieve top artists for
     * @param int $limit the number of results to fetch per page. Defaults to 50
     * @param int $page the page number to fetch. Defaults to first page
     */
    public function getTopTracks($user, $period = null, $limit = null, $page = null)
    {
        $response = $this->call(array(
            'method' => 'user.getTopTracks',
            'user' => $user,
            'period' => $period,
            'limit' => $limit,
            'page' => $page
        ));

        $tracks = array();
        if (!empty($response->toptracks->track)) {
            foreach ($response->toptracks->track as $track) {
                $tracks[(int)$track->attributes()->rank] = LastfmModel\Track::createFromResponse($track);
            }
        }

        return $tracks;
    }

    /**
     * Get the metadata for a user
     *
     * @param string $user the user name
     * @param string $lang the language to return the info in, expressed as an ISO 639 alpha-2 code.
     */
    public function getInfo($user, $lang = null)
    {
        $response = $this->call(array(
            'method' => 'user.getInfo',
            'user' => $user,
            'lang' => $lang
        ));

        $responseUser = null;
        if (!empty($response->user)) {
                $responseUser = LastfmModel\User::createFromResponse($response->user);
        }

        return $responseUser;
    }

    /**
     * Fetches the top tags for a user on Last.fm, sorted by popularity (number of times used)
     */
    public function getTopTags($user)
    {
        $response = $this->call(array(
            'method' => 'tag.getTopTags',
            'user' => $user,
            'limit' => $limit
        ));

        $tags = array();
        if (!empty($response->toptags->tag)) {
            foreach ($response->toptags->tag as $tag) {
                $tags[] = LastfmModel\Tag::createFromResponse($tag);
            }
        }

        return $tags;
    }

    /**
     * Get a list of available charts for this user, expressed as date ranges which can be sent to the chart services.
     *
     * @param string $user the user name
     */
    public function getWeeklyChartList($user)
    {
        $response = $this->call(array(
            'method' => 'user.getWeeklyChartList',
            'user' => $user
        ));

        $charts = array();
        if (!empty($response->weeklychartlist)) {
            foreach ($response->weeklychartlist->chart as $chart) {
                $charts[] = LastfmModel\Chart::createFromResponse($chart);
            }
        }

        return $charts;
    }

    /**
     *
     * @param string $user the user name
     * @param int $from the date at which the chart should start from. See getWeeklyChartList for more.
     * @param int $to the date at which the chart should end on. See getWeeklyChartList for more.
     * @param int $limit the number of results to fetch per page. Defaults to 50
     */
    public function getWeeklyArtistChart($user, $from = null, $to = null, $limit = null)
    {
        $response = $this->call(array(
            'method' => 'user.getWeeklyArtistChart',
            'user' => $user,
            'from' => $from,
            'to' => $to,
            'limit' => $limit
        ));

        $artists = array();
        if (!empty($response->weeklyartistchart->artist)) {
            foreach ($response->weeklyartistchart->artist as $artist) {
                $artists[] = LastfmModel\Artist::createFromResponse($artist);
            }
        }

        return $artists;
    }

}
