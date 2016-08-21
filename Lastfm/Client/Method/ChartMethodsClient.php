<?php

namespace BinaryThinking\LastfmBundle\Lastfm\Client\Method;

use BinaryThinking\LastfmBundle\Lastfm\Client\LastfmAPIClient;
use BinaryThinking\LastfmBundle\Lastfm\Model as LastfmModel;

/**
 * ChartMethodsClient
 *
 * @author Karol Sójko <karolsojko@gmail.com>
 * @author Chris Neale [https://github.com/cdn]
 */
class ChartMethodsClient extends LastfmAPIClient
{

    /**
    * Get the top artists on Last.fm, ordered by play count.
    *
    * @param int $limit the number of results to fetch per page. Defaults to 50
    * @param int $page the page number to fetch. Defaults to first page
    */
    public function getTopArtists($limit = null, $page = null)
    {
        $response = $this->call(array(
            'method' => 'chart.getTopArtists',
            'limit' => $limit,
            'page' => $page
        ));

        $artists = array();
        if (!empty($response->artists->artist)) {
            foreach ($response->artists->artist as $artist) {
                $artists[] = LastfmModel\Artist::createFromResponse($artist);
            }
        }

        return $artists;
    }

    /**
     * Fetches the top tags on Last.fm, sorted by popularity (number of times used)
     */
    public function getTopTags($page = null, $limit = null)
    {
        $response = $this->call(array(
            'method' => 'chart.getTopTags',
            'page' => $page,
            'limit' => $limit
        ));

        $tags = array();
        if (!empty($response->tags->tag)) {
            foreach ($response->tags->tag as $tag) {
                $tags[] = LastfmModel\Tag::createFromResponse($tag);
            }
        }

        return $tags;
    }

    /**
     * Get the top tracks tagged by this user, ordered by play count.
     *
     * @param int $limit the number of results to fetch per page. Defaults to 50
     * @param int $page the page number to fetch. Defaults to first page
     */
    public function getTopTracks($limit = null, $page = null)
    {
        $response = $this->call(array(
            'method' => 'chart.getTopTracks',
            'limit' => $limit,
            'page' => $page
        ));

        $tracks = array();
        if (!empty($response->tracks->track)) {
            foreach ($response->tracks->track as $track) {
                $tracks[] = LastfmModel\Track::createFromResponse($track);
            }
        }

        return $tracks;
    }

}
