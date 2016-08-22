<?php

namespace BinaryThinking\LastfmBundle\Lastfm\Client\Method;

use BinaryThinking\LastfmBundle\Lastfm\Client\LastfmAPIClient;
use BinaryThinking\LastfmBundle\Lastfm\Model as LastfmModel;

/**
 * TagMethodsClient
 *
 * @author Karol Sójko <karolsojko@gmail.com>
 */
class TagMethodsClient extends LastfmAPIClient
{

    /**
     * Get the top artists tagged by this tag, ordered by tag count.
     * 
     * @param string $tag the tag name
     * @param int $limit the number of results to fetch per page. Defaults to 50
     * @param int $page the page number to fetch. Defaults to first page
     */
    public function getTopArtists($tag, $limit = null, $page = null)
    {
        $response = $this->call(array(
            'method' => 'tag.getTopArtists',
            'tag' => $tag,
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
     * Get the top albums tagged by this tag, ordered by tag count.
     * 
     * @param string $tag the tag name
     * @param int $limit the number of results to fetch per page. Defaults to 50
     * @param int $page the page number to fetch. Defaults to first page
     */
    public function getTopAlbums($tag, $limit = null, $page = null)
    {
        $response = $this->call(array(
            'method' => 'tag.getTopAlbums',
            'tag' => $tag,
            'limit' => $limit,
            'page' => $page
        ));
        
        $albums = array();
        if (!empty($response->albums->album)) {
            foreach ($response->albums->album as $album) {
                $albums[(int)$album->attributes()->rank] = LastfmModel\Album::createFromResponse($album);
            }
        }
        
        return $albums;        
    }
    
    /**
     * Get the top tracks tagged by this tag, ordered by tag count.
     * 
     * @param string $tag the tag name
     * @param int $limit the number of results to fetch per page. Defaults to 50
     * @param int $page the page number to fetch. Defaults to first page
     */    
    public function getTopTracks($tag, $limit = null, $page = null)
    {
        $response = $this->call(array(
            'method' => 'tag.getTopTracks',
            'tag' => $tag,
            'limit' => $limit,
            'page' => $page
        ));
        
        $tracks = array();
        if (!empty($response->tracks->track)) {
            foreach ($response->tracks->track as $track) {
                $tracks[(int)$track->attributes()->rank] = LastfmModel\Track::createFromResponse($track);
            }
        }
        
        return $tracks;
    }
    
    /**
     * Get the metadata for a tag
     * 
     * @param string $tag the tag name
     * @param string $lang the language to return the info in, expressed as an ISO 639 alpha-2 code.
     */
    public function getInfo($tag, $lang = null)
    {
        $response = $this->call(array(
            'method' => 'tag.getInfo',
            'tag' => $tag,
            'lang' => $lang
        ));
        
        $responseTag = null;
        if (!empty($response->tag)) {
                $responseTag = LastfmModel\Tag::createFromResponse($response->tag);
        }
        
        return $responseTag;        
    }
    
    /**
     * Search for tags similar to this one. Returns tags ranked by similarity, based on listening data.
     * 
     * @param string $tag the tag name
     */
    public function getSimilar($tag)
    {
        $response = $this->call(array(
            'method' => 'tag.getSimilar',
            'tag' => $tag
        ));
        
        $tags = array();
        if (!empty($response->similartags->tag)) {
            foreach ($response->similartags->tag as $responseTag) {
                $tags[] = LastfmModel\Tag::createFromResponse($responseTag);
            }
        }
        
        return $tags;
    }
    
    /**
     * Fetches the top global tags on Last.fm, sorted by popularity (number of times used)
     */
    public function getTopTags()
    {
        $response = $this->call(array(
            'method' => 'tag.getTopTags'
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
     * Search for a tag by name. Returns matches sorted by relevance.
     * 
     * @param string $tag the tag name
     * @param int $limit the number of results to fetch per page. Defaults to 50
     * @param int $page the page number to fetch. Defaults to first page
     */ 
    public function search($tag, $limit = null, $page = null)
    {
        $response = $this->call(array(
            'method' => 'tag.search',
            'tag' => $tag,
            'limit' => $limit,
            'page' => $page
        ));
        
        $tags = array();
        if (!empty($response->results->tagmatches->tag)) {
            foreach ($response->results->tagmatches->tag as $responseTag) {
                $tags[] = LastfmModel\Tag::createFromResponse($responseTag);
            }
        }
        
        return $tags;
    }
    
    /**
     * Get a list of available charts for this tag, expressed as date ranges which can be sent to the chart services.
     * 
     * @param string $tag the tag name
     */
    public function getWeeklyChartList($tag)
    {
        $response = $this->call(array(
            'method' => 'tag.getWeeklyChartList',
            'tag' => $tag
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
     * @deprecated
     * 
     * @param string $tag the tag name
     * @param int $from the date at which the chart should start from. See getWeeklyChartList for more.
     * @param int $to the date at which the chart should end on. See getWeeklyChartList for more.
     * @param int $limit the number of results to fetch per page. Defaults to 50
     */
    public function getWeeklyArtistChart($tag, $from = null, $to = null, $limit = null)
    {
        $response = $this->call(array(
            'method' => 'tag.getWeeklyArtistChart',
            'tag' => $tag,
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
