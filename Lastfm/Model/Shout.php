<?php

namespace BinaryThinking\LastfmBundle\Lastfm\Model;

/**
 * Shout
 *
 * @author Karol Sójko <karolsojko@gmail.com>
 */
class Shout implements LastfmModelInterface
{
    protected $body;
    
    protected $author;
    
    protected $date;
    
    public static function createFromResponse(\SimpleXMLElement $response)
    {
        $shout = new Shout();
        $shout->setAuthor((string) $response->author);
        $shout->setBody((string) $response->body);
        $shout->setDate((string) $response->date);
        
        return $shout;
    }
    
    public function getBody()
    {
        return $this->body;
    }

    public function setBody($body)
    {
        $this->body = $body;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

}
