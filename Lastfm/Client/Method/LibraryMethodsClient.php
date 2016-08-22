<?php

namespace BinaryThinking\LastfmBundle\Lastfm\Client\Method;

use BinaryThinking\LastfmBundle\Lastfm\Client\LastfmAPIClient;
use BinaryThinking\LastfmBundle\Lastfm\Model as LastfmModel;

/**
 * LibraryMethodsClient
 *
 * @author Chris Neale [https://github.com/cdn]
 */
class LibraryMethodsClient extends LastfmAPIClient
{

    /**
    * Get the artists played by this user, ordered by play count.
    *
    * @param string $user the user name
    * @param int $limit the number of results to fetch per page. Defaults to 50
    * @param int $page the page number to fetch. Defaults to first page
    */
    public function getArtists($user, $limit = null, $page = null)
    {
        $response = $this->call(array(
            'method' => 'library.getArtists',
            'user' => $user,
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

}
