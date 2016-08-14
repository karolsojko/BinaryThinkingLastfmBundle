<?php

namespace BinaryThinking\LastfmBundle\Lastfm\Model;

/**
 * User
 *
 * @author Karol Sójko <karolsojko@gmail.com>
 */
class User implements LastfmModelInterface
{
    protected $name;

    protected $realName;

    protected $url;

    protected $images = array();

    protected $playcount;

    protected $playlists;

    protected $weight;

    public static function createFromResponse(\SimpleXMLElement $response)
    {
        $user = new User();
        $user->setName((string) $response->name);
        $user->setRealName((string) $response->realname);
        $user->setUrl((string) $response->url);
        $user->setPlayCount((int) $response->playcount);
        $user->setWeight((int) $response->weight);
        $images = array();
        foreach ($response->image as $image) {
            $imageAttributes = $image->attributes();
            if(!empty($imageAttributes->size)){
                $images[(string) $imageAttributes->size] = (string) $image;
            }
        }
        $user->setImages($images);

        return $user;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getPlayCount()
    {
        return $this->playcount;
    }

    public function setPlayCount($playcount)
    {
        $this->playcount = $playcount;
    }

    public function getRealName()
    {
        return $this->realName;
    }

    public function setRealName($realName)
    {
        $this->realName = $realName;
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

    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

}
