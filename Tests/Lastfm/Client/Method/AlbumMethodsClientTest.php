<?php

namespace BinaryThinking\LastfmBundle\Tests\Lastfm\Client\Method;

/**
 * AlbumMethodsClientTest
 *
 * @author Karol Sójko <karolsojko@gmail.com>
 */
class AlbumMethodsClientTest extends \PHPUnit_Framework_TestCase
{
    protected $apiKey;
    
    protected $apiSecret;
    
    public function setUp()
    {
        parent::setUp();
        $this->apiKey = 'test';
        $this->apiSecret = 'testSecret';
    }
    
    public function testSearch()
    {
        $albumClient = $this->getMock('BinaryThinking\LastfmBundle\Lastfm\Client\Method\AlbumMethodsClient', 
                array('call'), array($this->apiKey, $this->apiSecret));
        
        libxml_use_internal_errors(true);
        $mockSearchResponse = simplexml_load_file(dirname(__FILE__) . '/Mock/Album/MockSearchAlbumResponse.xml');
        
        $albumClient->expects($this->any())
                ->method('call')
                ->will($this->returnValue($mockSearchResponse));
        
        $albums = $albumClient->search('Sound of perseverance');
        $this->assertNotEmpty($albums, 'no albums retrieved');
        
        $firstAlbum = reset($albums);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Album', $firstAlbum, 'album is not a valid instance of Album class');
        $this->assertEquals('Death', $firstAlbum->getArtist(), 'artist does not match');
    }
    
    public function testGetTopTags()
    {
        $albumClient = $this->getMock('BinaryThinking\LastfmBundle\Lastfm\Client\Method\AlbumMethodsClient', 
                array('call'), array($this->apiKey, $this->apiSecret));
        
        libxml_use_internal_errors(true);
        $mockTagResponse = simplexml_load_file(dirname(__FILE__) . '/Mock/Album/MockGetTopTagsAlbumResponse.xml');
        
        $albumClient->expects($this->any())
                ->method('call')
                ->will($this->returnValue($mockTagResponse));
        
        $topTags = $albumClient->getTopTags('Cynic', 'Focus');
        $this->assertNotEmpty($topTags, 'no album tags retrieved');
        
        $firstTag = reset($topTags);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Tag', $firstTag, 'tag is not a valid instance of Tag class');
        $this->assertEquals('albums I own', $firstTag->getName(), 'tag name does not match');
    }
    
    public function testGetTags()
    {
        $albumClient = $this->getMock('BinaryThinking\LastfmBundle\Lastfm\Client\Method\AlbumMethodsClient', 
                array('call'), array($this->apiKey, $this->apiSecret));
        
        libxml_use_internal_errors(true);
        $mockTagResponse = simplexml_load_file(dirname(__FILE__) . '/Mock/Album/MockGetTagsAlbumResponse.xml');
        
        $albumClient->expects($this->any())
                ->method('call')
                ->will($this->returnValue($mockTagResponse));
        
        $userTags = $albumClient->getTags('In Flames', 'Sounds of a playground fading', 'someUserName');
        $this->assertNotEmpty($userTags, 'no album tags retrieved');
        
        $firstTag = reset($userTags);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Tag', $firstTag, 'tag is not a valid instance of Tag class');
        $this->assertEquals('swedish', $firstTag->getName(), 'tag name does not match');
    }
    
    public function testGetInfo()
    {
        $albumClient = $this->getMock('BinaryThinking\LastfmBundle\Lastfm\Client\Method\AlbumMethodsClient', 
                array('call'), array($this->apiKey, $this->apiSecret));
        
        libxml_use_internal_errors(true);
        $mockGetInfoResponse = simplexml_load_file(dirname(__FILE__) . '/Mock/Album/MockGetInfoAlbumResponse.xml');
        
        $albumClient->expects($this->any())
                ->method('call')
                ->will($this->returnValue($mockGetInfoResponse));
        
        $album = $albumClient->getInfo('Death', 'Sound of perseverance');
        $this->assertNotEmpty($album, 'no album retrieved');
        
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Album', $album, 'album is not a valid instance of Album class');
        $this->assertEquals('Death', $album->getArtist(), 'artist does not match');
        $this->assertCount(9, $album->getTracks(), 'wrong number of tracks retrieved');
    }
    
}
