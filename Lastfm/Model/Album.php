<?php

namespace BinaryThinking\LastfmBundle\Lastfm\Model;

use BinaryThinking\LastfmBundle\Lastfm\Model\Track;

/**
 * Album
 *
 * @author Karol Sójko <karolsojko@gmail.com>
 */
class Album implements LastfmModelInterface
{
    
    protected $id;
    
    protected $name;
    
    protected $artist;
    
    protected $url;
    
    protected $mbid;
    
    protected $releaseDate;
    
    protected $listeners;
    
    protected $playCount;
    
    protected $images = array();
    
    protected $streamable;
    
    protected $topTags = array();
    
    protected $tracks = array();
    
    public static function createFromResponse(\SimpleXMLElement $response){
        $album = new Album();
        $album->setId((int) $response->id);
        $album->setName((string) $response->name);
        $album->setArtist((string) $response->artist);
        $album->setUrl((string) $response->url);
        $images = array();
        foreach($response->image as $image){
            $images[] = (string) $image;
        }
        $album->setImages($images);
        $album->setStreamable((bool) $response->streamable);
        $album->setMbid((string) $response->mbid);
        $album->setReleaseDate((string) $response->releasedate);
        $album->setListeners((int) $response->listeners);
        $album->setPlayCount((int) $response->playcount);
        $album->setStreamable((int) $response->streamable);
        $topTags = array();
        foreach($response->toptags as $topTag){
            $topTags[] = $topTag;
        }
        $album->setTopTags($topTags);
        $tracks = array();
        if(!empty($response->tracks->track)){
            foreach($response->tracks->track as $track){
                $tracks[] = Track::createFromResponse($track);
            }
            $album->setTracks($tracks);            
        }
        
        return $album;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getArtist()
    {
        return $this->artist;
    }

    public function setArtist($artist)
    {
        $this->artist = $artist;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getMbid()
    {
        return $this->mbid;
    }

    public function setMbid($mbid)
    {
        $this->mbid = $mbid;
    }

    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    public function setReleaseDate($releaseDate)
    {
        $this->releaseDate = $releaseDate;
    }

    public function getListeners()
    {
        return $this->listeners;
    }

    public function setListeners($listeners)
    {
        $this->listeners = $listeners;
    }

    public function getPlayCount()
    {
        return $this->playCount;
    }

    public function setPlayCount($playCount)
    {
        $this->playCount = $playCount;
    }

    public function getImages()
    {
        return $this->images;
    }

    public function setImages($images)
    {
        $this->images = $images;
    }

    public function getStreamable()
    {
        return $this->streamable;
    }

    public function setStreamable($streamable)
    {
        $this->streamable = $streamable;
    }

    public function getTopTags()
    {
        return $this->topTags;
    }

    public function setTopTags($topTags)
    {
        $this->topTags = $topTags;
    }

    public function getTracks()
    {
        return $this->tracks;
    }

    public function setTracks($tracks)
    {
        $this->tracks = $tracks;
    }
    
}
