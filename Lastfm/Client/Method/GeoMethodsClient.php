<?php

namespace BinaryThinking\LastfmBundle\Lastfm\Client\Method;

use BinaryThinking\LastfmBundle\Lastfm\Client\LastfmAPIClient;
use BinaryThinking\LastfmBundle\Lastfm\Model as LastfmModel;
use BinaryThinking\LastfmBundle\Lastfm\Model\Geo;

/**
 * GeoMethodsClient class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class GeoMethodsClient extends LastfmAPIClient
{
    /**
     * Get list of top artists by country
     *
     * @link http://www.last.fm/api/show/geo.getTopArtists
     *
     * @param string $country country name
     *
     * @return Geo Geo
     */
    public function getTopArtists($country)
    {
        $response = $this->call(array(
            'method'  => 'geo.gettopartists',
            'country' => $country,
        ));

        $geo = array();
        if (!empty($response->topartists)) {
            $geo = LastfmModel\Geo::createFromResponse($response->topartists);
        }

        return $geo;
    }

    /**
     * Get list of top artists by country
     *
     * @link http://www.last.fm/api/show/geo.getTopTracks
     *
     * @param string $country  country name
     * @param string $location location
     *
     * @return Geo Geo
     */
    public function getTopTracks($country, $location = null)
    {
        $response = $this->call(array(
            'method'   => 'geo.gettoptracks',
            'country'  => $country,
            'location' => $location,
        ));

        $geo = array();
        if (!empty($response->tracks)) {
            $geo = LastfmModel\Geo::createFromResponse($response->tracks);
        }

        return $geo;
    }
}
