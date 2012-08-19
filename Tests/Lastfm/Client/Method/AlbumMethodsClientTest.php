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
    
    protected $albumClient;
    
    public function setUp()
    {
        parent::setUp();
        $this->apiKey = 'test';
        $this->apiSecret = 'testSecret';
        
        $this->albumClient = $this->getMock('BinaryThinking\LastfmBundle\Lastfm\Client\Method\AlbumMethodsClient', 
                array('call'), array($this->apiKey, $this->apiSecret));
    }
    
    public function testSearch()
    {
        $this->stubCallMethod('MockSearchAlbumResponse');
        
        $albums = $this->albumClient->search('Sound of perseverance');
        $this->assertNotEmpty($albums, 'no albums retrieved');
        
        $firstAlbum = reset($albums);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Album', $firstAlbum, 'album is not a valid instance of Album class');
        $this->assertEquals('Death', $firstAlbum->getArtist(), 'artist does not match');
    }
    
    public function testGetTopTags()
    {
        $this->stubCallMethod('MockGetTopTagsAlbumResponse');
        
        $topTags = $this->albumClient->getTopTags('Cynic', 'Focus');
        $this->assertNotEmpty($topTags, 'no album tags retrieved');
        
        $firstTag = reset($topTags);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Tag', $firstTag, 'tag is not a valid instance of Tag class');
        $this->assertEquals('albums I own', $firstTag->getName(), 'tag name does not match');
    }
    
    public function testGetTags()
    {
        $this->stubCallMethod('MockGetTagsAlbumResponse');
        
        $userTags = $this->albumClient->getTags('In Flames', 'Sounds of a playground fading', 'someUserName');
        $this->assertNotEmpty($userTags, 'no album tags retrieved');
        
        $firstTag = reset($userTags);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Tag', $firstTag, 'tag is not a valid instance of Tag class');
        $this->assertEquals('swedish', $firstTag->getName(), 'tag name does not match');
    }
    
    public function testGetInfo()
    {
        $this->stubCallMethod('MockGetInfoAlbumResponse');

        $album = $this->albumClient->getInfo('Death', 'Sound of perseverance');
        $this->assertNotEmpty($album, 'no album retrieved');
        
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Album', $album, 'album is not a valid instance of Album class');
        $this->assertEquals('Death', $album->getArtist(), 'artist does not match');
        $this->assertCount(9, $album->getTracks(), 'wrong number of tracks retrieved');
    }
    
    public function testGetShouts()
    {
        $this->stubCallMethod('MockGetShoutsAlbumResponse');

        $shouts = $this->albumClient->getShouts('Death', 'Sound of perseverance');
        $this->assertNotEmpty($shouts, 'no shouts retrieved');
        
        $firstShout = reset($shouts);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Shout', $firstShout, 'shout is not a valid instance of Shout class');
        $this->assertEquals('Just cannot get enough', $firstShout->getBody(), 'shout does not match');
    }    
    
    public function testGetBuylinks()
    {
        $this->stubCallMethod('MockGetBuylinksAlbumResponse');
        
        $affiliations = $this->albumClient->getBuylinks('TestArtist', 'test album');
        $this->assertNotEmpty($affiliations, 'no affiliations retrieved');
        
        $this->assertNotEmpty($affiliations['physicals'], 'no physical affiliations retrieved');
        $this->assertNotEmpty($affiliations['downloads'], 'no downloadable affiliations retrieved');
        
        $firstPhysical = reset($affiliations['physicals']);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Affiliation', $firstPhysical, 'wrong instance of affiliation');
        $this->assertEquals('Amazon', $firstPhysical->getSupplierName(), 'wrong supplier name');
        
        $firstDownloadable = reset($affiliations['downloads']);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Affiliation', $firstDownloadable, 'wrong instance of affiliation');
        $this->assertEquals('Amazon MP3', $firstDownloadable->getSupplierName(), 'wrong supplier name');
    }
    
    protected function stubCallMethod($mockResponseName)
    {
        libxml_use_internal_errors(true);
        $mockGetInfoResponse = simplexml_load_file(dirname(__FILE__) . '/Mock/Album/' . $mockResponseName . '.xml');

        $this->albumClient->expects($this->any())
                ->method('call')
                ->will($this->returnValue($mockGetInfoResponse));        
    }
    
}
