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
        $client = LastfmAPIClientFactory::getClient('someclient', $this->apiKey, $this->apiSecret);
    }
    
    public function testGetClientForAlbum()
    {
        $albumClient = LastfmAPIClientFactory::getClient('album', $this->apiKey, $this->apiSecret);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Client\Method\AlbumMethodsClient', $albumClient, 'wrong client delivered');
    }
    
    public function testGetAlbumClient()
    {
        $albumClient = LastfmAPIClientFactory::getAlbumClient($this->apiKey, $this->apiSecret);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Client\Method\AlbumMethodsClient', $albumClient, 'wrong client delivered');
    }
}
