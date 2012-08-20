<?php

namespace BinaryThinking\LastfmBundle\Lastfm\Client\Method;

use BinaryThinking\LastfmBundle\Lastfm\Client\LastfmAPIClient;
use BinaryThinking\LastfmBundle\Lastfm\Model as LastfmModel;

/**
 * ArtistMethodsClient
 *
 * @author Karol Sójko <karolsojko@gmail.com>
 */
class ArtistMethodsClient extends LastfmAPIClient
{
    /**
     * Use the last.fm corrections data to check whether the supplied artist has a correction to a canonical artist
     * 
     * @param string $artist the artist name to correct
     */
    public function getCorrection($artist)
    {
        $response = $this->call(array(
            'method' => 'artist.getCorrection',
            'artist' => $artist
        ));
        
        $corrections = array();
        if(!empty($response->corrections->correction)){
            foreach($response->corrections->correction as $correction){
                $corrections[] = LastfmModel\Artist::createFromResponse($correction->artist);
            }
        }
        
        return $corrections;
    }
    
    /**
     * Get a list of upcoming events for this artist. Easily integratable into calendars, using the ical standard (see feeds section below).
     * 
     * @param string $artist the artist name
     * @param string $mbid the musicbrainz id for the artist
     * @param int $limit the number of results to fetch per page. Defaults to 50
     * @param int $page the page number to fetch. Defaults to first page
     * @param bool $autocorrect transform misspelled artist names into correct artist names, returning the correct version instead. The corrected artist name will be returned in the response
     * @param bool $festivalsOnly whether only festivals should be returned, or all events
     */
    public function getEvents($artist, $mbid = null, $limit = null, $page = null, $autocorrect = true, $festivalsOnly = false)
    {
        $respone = $this->call(array(
            'method' => 'artist.getEvents',
            'artist' => $artist,
            'mbid' => $mbid,
            'limit' => $limit,
            'page' => $page,
            'autocorrect' => $autocorrect,
            'festivalsonly' => $festivalsOnly
        ));
        
        $events = array();
        if(!empty($respone->events->event)){
            foreach($respone->events->event as $event){
                $events[] = LastfmModel\Event::createFromResponse($event);
            }
        }
        
        return $events;
    }
    
    
}
