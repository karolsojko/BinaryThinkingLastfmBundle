<?php

namespace BinaryThinking\LastfmBundle\Lastfm\Client;

use BinaryThinking\LastfmBundle\Lastfm\Client\Method;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;

/**
 * LastfmAPIClientFactory
 *
 * @author Karol Sójko <karolsojko@gmail.com>
 */
class LastfmAPIClientFactory 
{
    
    public static function getClient($clientName, $apiKey, $apiSecret)
    {
        switch(strtolower($clientName)){
            case 'album':
                return self::getAlbumClient($apiKey, $apiSecret);
                break;
            case 'artist':
                return self::getArtistClient($apiKey, $apiSecret);
                break;
            case 'tag':
                return self::getTagClient($apiKey, $apiSecret);
                break;
            default:
                throw new InvalidArgumentException('invalid client name: ' . $clientName);
        }
    }
    
    public static function getAlbumClient($apiKey, $apiSecret)
    {
        return new Method\AlbumMethodsClient($apiKey, $apiSecret);
    }
    
    public static function getArtistClient($apiKey, $apiSecret)
    {
        return new Method\ArtistMethodsClient($apiKey, $apiSecret);
    }    
    
    public static function getTagClient($apiKey, $apiSecret)
    {
        return new Method\TagMethodsClient($apiKey, $apiSecret);
    }
    
}
