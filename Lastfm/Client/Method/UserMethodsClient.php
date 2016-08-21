<?php

namespace BinaryThinking\LastfmBundle\Lastfm\Client\Method;

use BinaryThinking\LastfmBundle\Lastfm\Client\LastfmAPIClient;
use BinaryThinking\LastfmBundle\Lastfm\Model as LastfmModel;

/**
 * UserMethodsClient
 *
 * @author Karol Sójko <karolsojko@gmail.com>
 * @author Chris Neale [https://github.com/cdn]
 */
class UserMethodsClient extends LastfmAPIClient
{

    /**
     * Get a list of tracks by a given artist scrobbled by this user, including scrobble time.
     * Can be limited to specific timeranges, defaults to all time
     *
     * @param string $user the user name
     * @param string $artist the artist name
     * @param int $startTimestamp the unix timestamp to start at
     * @param string $page the page number to fetch. Defaults to first page
     * @param int $endTimestamp the timestamp to end at
     */
    public function getArtistTracks($user, $artist, $startTimestamp = null, $page = null, $endTimestamp = null)
    {
        $response = $this->call(array(
            'method' => 'user.getArtistTracks',
            'user' => $user,
            'artist' => $artist,
            'startTimestamp' => $startTimestamp,
            'page' => $page,
            'endTimestamp' => $endTimestamp
        ));

        $tracks = array();
        if (!empty($response->artisttracks->track)) {
            foreach ($response->artisttracks->track as $track) {
                $tracks[strftime($track->date)] = LastfmModel\Track::createFromResponse($track);
            }
        }

        return $tracks;
    }

    /**
     * Get a list of the user's friends on Last.fm
     *
     * @param string $user the user name
     * @param int $recenttracks whether to include information about friends' recent listening in the response
     * @param int $limit the number of results to fetch per page. Defaults to 50
     * @param int $page the page number to fetch. Defaults to first page
     */
    public function getFriends($user, $recenttracks = null, $limit = null, $page = null)
    {
        $response = $this->call(array(
            'method' => 'user.getFriends',
            'user' => $user,
            'recenttracks' => $recenttracks,
            'limit' => $limit,
            'page' => $page
        ));

        $users = array();
        if (!empty($response->friends->user)) {
            foreach ($response->friends->user as $user) {
                $users[] = LastfmModel\User::createFromResponse($user);
            }
        }

        return $users;
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
     * Get the last 50 tracks loved by a user
     *
     * @param string $user the user name
     * @param int $limit the number of results to fetch per page. Defaults to 50
     * @param int $page the page number to fetch. Defaults to first page
     */
    public function getLovedTracks($user, $limit = null, $page = null)
    {
        $response = $this->call(array(
            'method' => 'user.getLovedTracks',
            'user' => $user,
            'limit' => $limit,
            'page' => $page
        ));

        $tracks = array();
        if (!empty($response->lovedtracks->track)) {
            foreach ($response->lovedtracks->track as $track) {
                $tracks[] = LastfmModel\Track::createFromResponse($track);
            }
        }

        return $tracks;
    }

    /**
     * Get the user's personal tags
     *
     * @param string $user the user name
     * @param string $tag the tag name
     * @param string $taggingtype the type [artist|album|track] of items which have been tagged
     * @param int $limit the number of results to fetch per page. Defaults to 50
     * @param int $page the page number to fetch. Defaults to first page
     */
    public function getPersonalTags($user, $tag, $taggingtype, $limit = null, $page = null)
    {
        $response = $this->call(array(
            'method' => 'user.getPersonalTags',
            'user' => $user,
            'tag' => $tag,
            'taggingtype' => $taggingtype,
            'limit' => $limit,
            'page' => $page
        ));

        switch($taggingtype)
        {
            case 'album':
                $albums = array();
                if (!empty($response->taggings->albums->album)) {
                    foreach ($response->taggings->albums->album as $album) {
                        $albums[] = LastfmModel\Album::createFromResponse($album);
                    }
                }
                $items = $albums;
                break;

            case 'artist':
                $artists = array();
                if (!empty($response->taggings->artists->artist)) {
                    foreach ($response->taggings->artists->artist as $artist) {
                        $artists[] = LastfmModel\Artist::createFromResponse($artist);
                    }
                }
                $items = $artists;
                break;

            case 'track':
                $tracks = array();
                if (!empty($response->taggings->tracks->track)) {
                    foreach ($response->taggings->tracks->track as $track) {
                        $tracks[] = LastfmModel\Track::createFromResponse($track);
                    }
                }
                $items = $tracks;
                break;
        }

        return $items;
    }

    /**
     * Get a list of the recent tracks listened to by this user.
     * Also includes the currently playing track with the nowplaying="true"
     * attribute if the user is currently listening
     *
     * @param string $user the user name
     * @param int $extended include extended data in each artist,
     *                      and whether the user has loved each track
     * @param int $from beginning timestamp of a range
     *                  - only display scrobbles after this time, UNIX timestamp
     * @param int $to end timestamp of a range. UTC timezone
     * @param int $limit the number of results per page. Defaults to 50. Max 200
     * @param int $page the page number to fetch. Defaults to first page
     */
    public function getRecentTracks($user, $extended = 1, $from = null, $to = null, $limit = null, $page = null)
    {
        $response = $this->call(array(
            'method' => 'user.getRecentTracks',
            'user' => $user,
            'extended' => $extended,
            'from' => $from,
            'to' => $to,
            'limit' => $limit,
            'page' => $page
        ));

        $tracks = array();
        if (!empty($response->recenttracks->track)) {
            foreach ($response->recenttracks->track as $track) {
                $tracks[strftime($track->date)] = LastfmModel\Track::createFromResponse($track);
            }
        }

        return $tracks;
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
     * Fetches the top tags for a user on Last.fm, sorted by popularity (number of times used)
     */
    public function getTopTags($user, $limit = null)
    {
        $response = $this->call(array(
            'method' => 'user.getTopTags',
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
     * Get an album chart for a user profile, for a given date range
     *
     * @param string $user the user name
     * @param int $from the date at which the chart should start from. See getWeeklyChartList for more.
     * @param int $to the date at which the chart should end on. See getWeeklyChartList for more.
     */
    public function getWeeklyAlbumChart($user, $from = null, $to = null)
    {
        $response = $this->call(array(
            'method' => 'user.getWeeklyAlbumChart',
            'user' => $user,
            'from' => $from,
            'to' => $to
        ));

        $albums = array();
        if (!empty($response->weeklyalbumchart->album)) {
            foreach ($response->weeklyalbumchart->album as $album) {
                $albums[] = LastfmModel\Album::createFromResponse($album);
            }
        }

        return $albums;
    }

    /**
     *
     * @param string $user the user name
     * @param int $from the date at which the chart should start from. See getWeeklyChartList for more.
     * @param int $to the date at which the chart should end on. See getWeeklyChartList for more.
     */
    public function getWeeklyArtistChart($user, $from = null, $to = null)
    {
        $response = $this->call(array(
            'method' => 'user.getWeeklyArtistChart',
            'user' => $user,
            'from' => $from,
            'to' => $to
        ));

        $artists = array();
        if (!empty($response->weeklyartistchart->artist)) {
            foreach ($response->weeklyartistchart->artist as $artist) {
                $artists[] = LastfmModel\Artist::createFromResponse($artist);
            }
        }

        return $artists;
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
     * Get a track chart for a user profile, for a given date range
     *
     * @param string $user the user name
     * @param int $from the date at which the chart should start from. See getWeeklyChartList for more.
     * @param int $to the date at which the chart should end on. See getWeeklyChartList for more.
     */
    public function getWeeklyTrackChart($user, $from = null, $to = null)
    {
        $response = $this->call(array(
            'method' => 'user.getWeeklyTrackChart',
            'user' => $user,
            'from' => $from,
            'to' => $to
        ));

        $tracks = array();
        if (!empty($response->weeklytrackchart->track)) {
            foreach ($response->weeklytrackchart->track as $track) {
                $tracks[(int)$track->attributes()->rank] = LastfmModel\Track::createFromResponse($track);
            }
        }

        return $tracks;
    }

}
