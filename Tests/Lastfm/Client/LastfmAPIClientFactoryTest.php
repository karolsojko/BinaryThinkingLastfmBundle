<?php

namespace BinaryThinking\LastfmBundle\Tests\Lastfm\Client;

use BinaryThinking\LastfmBundle\Lastfm\Client\LastfmAPIClientFactory;

/**
 * LastfmAPIClientFactoryTest
 *
 * @author Karol Sójko <karolsojko@gmail.com>
 */
class LastfmAPIClientFactoryTest extends \PHPUnit_Framework_TestCase
{
    protected $apiKey;
    
    protected $apiSecret;

    protected function setUp()
    {
        parent::setUp();
        $this->apiKey = 'test';
        $this->apiSecret = 'testSecret';
    }
    
    /**
     * @expectedException Symfony\Component\DependencyInjection\Exception\InvalidArgumentException
     */
    public function testGetInvalidClient()
    {
        $client = LastfmAPIClientFactory::getClient('someclient', 
                $this->apiKey, $this->apiSecret);
    }
    
    public function testGetClientForAlbum()
    {
        $albumClient = LastfmAPIClientFactory::getClient('album',
                $this->apiKey, $this->apiSecret);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Client\Method\AlbumMethodsClient',
                $albumClient, 'wrong client delivered');
    }
    
    public function testGetAlbumClient()
    {
        $albumClient = LastfmAPIClientFactory::getAlbumClient($this->apiKey, $this->apiSecret);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Client\Method\AlbumMethodsClient',
                $albumClient, 'wrong client delivered');
    }
    
    public function testGetClientForArtist()
    {
        $artistClient = LastfmAPIClientFactory::getClient('artist', $this->apiKey, $this->apiSecret);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Client\Method\ArtistMethodsClient',
                $artistClient, 'wrong client delivered');
    }    
    
    public function testGetArtistClient()
    {
        $artistClient = LastfmAPIClientFactory::getArtistClient($this->apiKey, $this->apiSecret);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Client\Method\ArtistMethodsClient',
                $artistClient, 'wrong client delivered');
    }
    
    public function testGetClientForTag()
    {
        $tagClient = LastfmAPIClientFactory::getClient('tag', $this->apiKey, $this->apiSecret);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Client\Method\TagMethodsClient',
                $tagClient, 'wrong client delivered');
    }
    
    public function testGetTagClient()
    {
        $tagClient = LastfmAPIClientFactory::getTagClient($this->apiKey, $this->apiSecret);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Client\Method\TagMethodsClient',
                $tagClient, 'wrong client delivered');
    }
    
}
