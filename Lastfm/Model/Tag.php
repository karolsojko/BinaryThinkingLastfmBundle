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
    
    public static function createFromResponse(\SimpleXMLElement $response){
        $tag = new Tag();
        $tag->setName((string) $response->name);
        $tag->setCount((int) $response->count);
        $tag->setUrl((string) $response->url);
        
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

}
