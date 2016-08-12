<?php

namespace BinaryThinking\LastfmBundle\Lastfm\Model;

use BinaryThinking\LastfmBundle\Lastfm\Model\Tag;

/**
 * Artist
 *
 * @author Karol Sójko <karolsojko@gmail.com>
 */
class Artist implements LastfmModelInterface
{
    protected $name;

    protected $mbid;

    protected $url;

    protected $images;

    protected $streamable;

    protected $listeners;

    protected $playCount;

    protected $similar = array();

    protected $tags = array();

    protected $bio = array();

    protected $weight;

    public static function createFromResponse(\SimpleXMLElement $response)
    {
        $artist = new Artist();
        $artist->setName((string) $response);
        if (isset($response->name)) {
            $artist->setName((string) $response->name);
        }
        $artistAttributes = $response->attributes();
        if (!isset($response->mbid) && isset($artistAttributes->mbid)){
            $response->mbid = $artistAttributes->mbid;
        }
        $artist->setMbid((string) $response->mbid);
        $artist->setUrl((string) $response->url);

        $images = array();
        if(!empty($response->image)){
            foreach($response->image as $image){
                $imageAttributes = $image->attributes();
                if(!empty($imageAttributes->size)){
                    $images[(string) $imageAttributes->size] = (string) $image;
                }
            }
        }
        $artist->setImages($images);

        $artist->setStreamable((int) $response->streamable);

        if(!empty($response->stats)){
            $artist->setListeners((int) $response->stats->listeners);
            $artist->setPlayCount((int) $response->stats->playcount);
        }
        elseif(isset($response->listeners)){
            $artist->setListeners((int) $response->listeners);
        }

        $similar = array();
        if(!empty($response->similar->artist)){
            foreach($response->similar->artist as $similarArtistXML){
                $similarArtist = self::createFromResponse($similarArtistXML);
                if(!empty($similarArtist)){
                    $similar[$similarArtist->getName()] = $similarArtist;
                }
            }
        }
        $artist->setSimilar($similar);

        $tags = array();
        if(!empty($response->tags->tag)){
            foreach($response->tags->tag as $tag){
                $tags[] = Tag::createFromResponse($tag);
            }
        }
        $artist->setTags($tags);

        $bio = array();
        if(!empty($response->bio)){
            $bio['published'] = (string) $response->bio->published;
            $bio['summary'] = (string) $response->bio->summary;
            $bio['content'] = (string) $response->bio->content;
        }
        $artist->setBio($bio);

        $artist->setWeight((int) $response->weight);

        return $artist;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
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

    public function getSimilar()
    {
        return $this->similar;
    }

    public function setSimilar($similar)
    {
        $this->similar = $similar;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    public function getBio()
    {
        return $this->bio;
    }

    public function setBio($bio)
    {
        $this->bio = $bio;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

}
