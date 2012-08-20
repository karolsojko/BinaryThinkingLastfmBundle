<?php

namespace BinaryThinking\LastfmBundle\Lastfm\Model;

use BinaryThinking\LastfmBundle\Lastfm\Model\Venue;

/**
 * Event
 *
 * @author Karol Sójko <karolsojko@gmail.com>
 */
class Event implements LastfmModelInterface
{
    
    protected $id;
    
    protected $title;
    
    protected $artists;
    
    protected $headliner;
    
    protected $venue;
    
    protected $startDate;
    
    protected $description;
    
    protected $images;
    
    protected $attendance;
    
    protected $reviews;
    
    protected $eventTag;
    
    protected $url;
    
    protected $website;
    
    protected $tickets;
    
    protected $cancelled;
    
    protected $tags;
    
    public static function createFromResponse(\SimpleXMLElement $response)
    {
        $event = new Event();
        $event->setId((int) $response->id);
        $event->setTitle((string) $response->title);
        $artists = array();
        foreach($response->artists->artist as $artist){
            $artists[] = (string) $artist;
        }
        $event->setArtists($artists);
        $event->setHeadliner((string) $response->artists->headliner);
        $venue = Venue::createFromResponse($response->venue);
        $event->setVenue($venue);
        $event->setStartDate((string) $response->startDate);
        $event->setDescription($response->description);
        $images = array();
        foreach($response->image as $image){
            $imageAttributes = $image->attributes();
            if(!empty($imageAttributes->size)){
                $images[(string) $imageAttributes->size] = (string) $image;
            } else {
                $images[] = (string) $image;
            }
        }
        $event->setImages($images);
        $event->setAttendance((int) $response->attendance);
        $event->setReviews((int) $response->reviews);
        $event->setEventTag((string) $response->tag);
        $event->setUrl((string) $response->url);
        $event->setWebsite((string) $response->website);
        $event->setTickets((int) $response->tickets);
        $event->setCancelled((int) $response->cancelled);
        $tags = array();
        foreach($response->tags->tag as $tag){
            $tags[] = (string) $tag;
        }
        $event->setTags($tags);
        
        return $event;
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getArtists()
    {
        return $this->artists;
    }

    public function setArtists($artists)
    {
        $this->artists = $artists;
    }
    
    public function getHeadliner()
    {
        return $this->headliner;
    }

    public function setHeadliner($headliner)
    {
        $this->headliner = $headliner;
    }
    
    public function getVenue()
    {
        return $this->venue;
    }

    public function setVenue($venue)
    {
        $this->venue = $venue;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getImages()
    {
        return $this->images;
    }

    public function setImages($images)
    {
        $this->images = $images;
    }

    public function getAttendance() 
    {
        return $this->attendance;
    }

    public function setAttendance($attendance)
    {
        $this->attendance = $attendance;
    }

    public function getReviews()
    {
        return $this->reviews;
    }

    public function setReviews($reviews)
    {
        $this->reviews = $reviews;
    }

    public function getEventTag()
    {
        return $this->eventTag;
    }

    public function setEventTag($eventTag)
    {
        $this->eventTag = $eventTag;
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

    public function getTickets()
    {
        return $this->tickets;
    }

    public function setTickets($tickets)
    {
        $this->tickets = $tickets;
    }

    public function getCancelled()
    {
        return $this->cancelled;
    }

    public function setCancelled($cancelled)
    {
        $this->cancelled = $cancelled;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function setTags($tags)
    {
        $this->tags = $tags;
    }

}
