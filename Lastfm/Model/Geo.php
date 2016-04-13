<?php

namespace BinaryThinking\LastfmBundle\Lastfm\Model;

use SimpleXMLElement;

/**
 * Geo class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class Geo implements LastfmModelInterface
{
    /** @var Artist[] $artists Array of artists */
    protected $artists = [];

    /** @var Track[] Array of artists */
    protected $tracks = [];

    /**
     * @param SimpleXMLElement $response SimpleXmlElement
     *
     * @return Geo
     */
    public static function createFromResponse(SimpleXMLElement $response)
    {
        $geo = new Geo();

        $artists = [];
        if (!empty($response->artist)) {
            foreach ($response->artist as $artistXML) {
                $artist = Artist::createFromResponse($artistXML);
                if (!empty($artist)) {
                    $artists[$artist->getName()] = $artist;
                }
            }
        }
        $geo->setArtists($artists);

        $tracks = [];
        if (!empty($response->track)) {
            foreach ($response->track as $trackXML) {
                $track = Track::createFromResponse($trackXML);
                if (!empty($track)) {
                    $tracks[$track->getName()] = $track;
                }
            }
        }
        $geo->setTracks($tracks);

        return $geo;
    }

    /**
     * Get artists
     *
     * @return Artist[] Array of Artists
     */
    public function getArtists()
    {
        return $this->artists;
    }

    /**
     * Set artists
     *
     * @param Artist[] $artists artists
     *
     * @return $this
     */
    public function setArtists($artists)
    {
        $this->artists = $artists;

        return $this;
    }

    /**
     * Get tracks
     *
     * @return Track[] Array of Tracks
     */
    public function getTracks()
    {
        return $this->tracks;
    }

    /**
     * Set tracks
     *
     * @param Track[] $tracks tracks
     *
     * @return $this
     */
    public function setTracks($tracks)
    {
        $this->tracks = $tracks;

        return $this;
    }
}
