<?php

namespace BinaryThinking\LastfmBundle\Lastfm\Model;

use BinaryThinking\LastfmBundle\Lastfm\Model\Artist;

/**
 * Track
 *
 * @author Karol Sójko <karolsojko@gmail.com>
 */
class Track implements LastfmModelInterface
{
    protected $number;
    
    protected $name;
    
    protected $duration;
    
    protected $playcount;
    
    protected $listeners;
    
    protected $mbid;
    
    protected $url;
    
    protected $streamable;
    
    protected $artist;
    
    protected $images = array();
    
    public static function createFromResponse(\SimpleXMLElement $response)
    {
        $track = new Track();
        $trackAttributes = $response->attributes();
        if(isset($trackAttributes->rank)){
            $track->setNumber((int) $trackAttributes->rank);
        }
        $track->setName((string) $response->name);
        $track->setDuration((int) $response->duration);
        $track->setMbid((string) $response->mbid);
        $track->setUrl((string) $response->url);
        $track->setStreamable((int) $response->streamable);
        
        if(!empty($response->artist)){
            $track->setArtist(Artist::createFromResponse($response->artist));
        }
        
        $track->setPlaycount((int) $response->playcount);
        $track->setListeners((int) $response->listeners);
        
        $images = array();
        foreach ($response->image as $image) {
            $imageAttributes = $image->attributes();
            if (!empty($imageAttributes->size)) {
                $images[(string) $imageAttributes->size] = (string) $image;
            }
        }
        $track->setImages($images);
        
        return $track;
    }
    
    public function getNumber()
    {
        return $this->number;
    }

    public function setNumber($number)
    {
        $this->number = $number;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    public function getMbid()
    {
        return $this->mbid;
    }

    public function setMbid($mbid)
    {
        $this->mbid = $mbid;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getStreamable()
    {
        return $this->streamable;
    }

    public function setStreamable($streamable)
    {
        $this->streamable = $streamable;
    }

    public function getArtist()
    {
        return $this->artist;
    }

    public function setArtist($artist) 
    {
        $this->artist = $artist;
    }
    
    public function getPlaycount()
    {
        return $this->playcount;
    }

    public function setPlaycount($playcount)
    {
        $this->playcount = $playcount;
    }

    public function getListeners()
    {
        return $this->listeners;
    }

    public function setListeners($listeners)
    {
        $this->listeners = $listeners;
    }

    public function getImages()
    {
        return $this->images;
    }

    public function setImages($images)
    {
        $this->images = $images;
    }

}
