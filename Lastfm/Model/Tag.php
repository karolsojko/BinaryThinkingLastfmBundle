<?php

namespace BinaryThinking\LastfmBundle\Lastfm\Model;

/**
 * Tag
 *
 * @author Karol Sójko <karolsojko@gmail.com>
 */
class Tag implements LastfmModelInterface
{
    
    protected $name;
    
    protected $count;
    
    protected $url;
    
    protected $reach;
    
    protected $taggings;
    
    protected $streamable;
    
    protected $published;
    
    protected $summary;
    
    protected $content;
    
    public static function createFromResponse(\SimpleXMLElement $response){
        $tag = new Tag();
        $tag->setName((string) $response->name);
        $tag->setCount((int) $response->count);
        $tag->setUrl((string) $response->url);
        $tag->setReach((int) $response->reach);
        $tag->setTaggings((int) $response->taggings);
        $tag->setStreamable((int) $response->streamable);
        $tag->setPublished((string) $response->wiki->published);
        $tag->setSummary((string) $response->wiki->summary);
        $tag->setContent((string) $response->wiki->content);
        
        return $tag;
    }
    
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getCount()
    {
        return $this->count;
    }

    public function setCount($count)
    {
        $this->count = $count;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }
    
    public function getReach()
    {
        return $this->reach;
    }

    public function setReach($reach)
    {
        $this->reach = $reach;
    }

    public function getTaggings()
    {
        return $this->taggings;
    }

    public function setTaggings($taggings)
    {
        $this->taggings = $taggings;
    }

    public function getStreamable()
    {
        return $this->streamable;
    }

    public function setStreamable($streamable)
    {
        $this->streamable = $streamable;
    }

    public function getPublished()
    {
        return $this->published;
    }

    public function setPublished($published)
    {
        $this->published = $published;
    }

    public function getSummary()
    {
        return $this->summary;
    }

    public function setSummary($summary)
    {
        $this->summary = $summary;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

}
