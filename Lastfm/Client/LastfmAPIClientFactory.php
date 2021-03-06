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
            case 'chart':
                return self::getChartClient($apiKey, $apiSecret);
                break;
            case 'geo':
                return self::getGeoClient($apiKey, $apiSecret);
                break;
            case 'library':
                return self::getLibraryClient($apiKey, $apiSecret);
                break;
            case 'tag':
                return self::getTagClient($apiKey, $apiSecret);
                break;
            case 'user':
                return self::getUserClient($apiKey, $apiSecret);
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

    public static function getChartClient($apiKey, $apiSecret)
    {
        return new Method\ChartMethodsClient($apiKey, $apiSecret);
    }

    public static function getGeoClient($apiKey, $apiSecret)
    {
        return new Method\GeoMethodsClient($apiKey, $apiSecret);
    }

    public static function getLibraryClient($apiKey, $apiSecret)
    {
        return new Method\LibraryMethodsClient($apiKey, $apiSecret);
    }

    public static function getTagClient($apiKey, $apiSecret)
    {
        return new Method\TagMethodsClient($apiKey, $apiSecret);
    }

    public static function getUserClient($apiKey, $apiSecret)
    {
        return new Method\UserMethodsClient($apiKey, $apiSecret);
    }

}
