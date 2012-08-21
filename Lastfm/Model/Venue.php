<?php

namespace BinaryThinking\LastfmBundle\Lastfm\Model;

/**
 * Venue
 *
 * @author Karol Sójko <karolsojko@gmail.com>
 */
class Venue implements LastfmModelInterface
{
    
    protected $id;
    
    protected $name;
    
    protected $location;
    
    protected $geoPoint;
    
    protected $url;
    
    protected $website;
    
    protected $phoneNumber;
    
    protected $images;
    
    public static function createFromResponse(\SimpleXMLElement $response)
    {
        $venue = new Venue();
        $venue->setId((int) $response->id);
        $venue->setName((string) $response->name);
        $location = array();
        $location['city'] = (string) $response->location->city;
        $location['country'] = (string) $response->location->country;
        $location['street'] = (string) $response->location->street;
        $location['postalcode'] = (string) $response->location->postalcode;
        $venue->setLocation($location);
        $geoPoint = array();
        $geoPoint['lat'] = $response->location->point->lat;
        $geoPoint['long'] = $response->location->point->long;
        $venue->setGeoPoint($geoPoint);
        $venue->setUrl((string) $response->url);
        $venue->setWebsite((string) $response->website);
        $venue->setPhoneNumber((string) $response->phonenumber);
        $images = array();
        foreach($response->image as $image){
            $imageAttributes = $image->attributes();
            if(!empty($imageAttributes->size)){
                $images[(string) $imageAttributes->size] = (string) $image;
            }
        }
        $venue->setImages($images);
        
        return $venue;
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

    public function getLocation()
    {
        return $this->location;
    }

    public function setLocation($location)
    {
        $this->location = $location;
    }

    public function getGeoPoint()
    {
        return $this->geoPoint;
    }

    public function setGeoPoint($geoPoint)
    {
        $this->geoPoint = $geoPoint;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getWebsite()
    {
        return $this->website;
    }

    public function setWebsite($website)
    {
        $this->website = $website;
    }

    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
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
