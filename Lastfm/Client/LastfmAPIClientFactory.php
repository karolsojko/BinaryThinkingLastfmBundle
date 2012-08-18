<?php

namespace BinaryThinking\LastfmBundle\Lastfm\Client;

use BinaryThinking\LastfmBundle\Lastfm\Client\Method\AlbumMethodsClient;
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
            default:
                throw new InvalidArgumentException('invalid client name: ' . $clientName);
        }
    }
    
    public static function getAlbumClient($apiKey, $apiSecret)
    {
        return new AlbumMethodsClient($apiKey, $apiSecret);
    }
    
}
