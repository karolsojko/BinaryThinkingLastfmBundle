<?php

namespace BinaryThinking\LastfmBundle\Lastfm\Model;

/**
 * Channel
 *
 * @author Karol Sójko <karolsojko@gmail.com>
 */
class Channel implements LastfmModelInterface
{
    protected $title;
    
    protected $link;
    
    protected $description;
    
    protected $items = array();
    
    public static function createFromResponse(\SimpleXMLElement $response)
    {
        $channel = new Channel();
        $channel->setTitle((string) $response->title);
        $channel->setLink((string) $response->link);
        $channel->setDescription((string) $response->description);
        $items = array();
        foreach ($response->item as $responseItem) {
            $items[] = array(
                'title' => (string) $responseItem->title,
                'guid' => (string) $responseItem->guid,
                'itunes_author' => (string) $responseItem->itunes->author,
                'enclosure_url' => (string) $responseItem->enclosure->attributes()->url,
                'description' => (string) $responseItem->description,
                'link' => (string) $responseItem->link
            );
        }
        $channel->setItems($items);
        
        return $channel;
    }
    
    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function setLink($link)
    {
        $this->link = $link;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function setItems($items)
    {
        $this->items = $items;
    }

}
