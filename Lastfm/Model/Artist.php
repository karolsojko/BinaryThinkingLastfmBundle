<?php

namespace BinaryThinking\LastfmBundle\Lastfm\Model;

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
    
    public static function createFromResponse(\SimpleXMLElement $response)
    {
        $artist = new Artist();
        $artist->setName((string) $response->name);
        $artist->setMbid((string) $response->mbid);
        $artist->setUrl((string) $response->url);
        
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

}
