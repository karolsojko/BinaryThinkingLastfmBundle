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
    
}
