<?php

namespace BinaryThinking\LastfmBundle\Tests\Lastfm\Client\Method;

/**
 * ArtistMethodsClientTest
 *
 * @author Karol Sójko <karolsojko@gmail.com>
 */
class ArtistMethodsClientTest extends \PHPUnit_Framework_TestCase
{
    protected $apiKey;
    
    protected $apiSecret;
    
    protected $artistClient;
    
    public function setUp()
    {
        parent::setUp();
        $this->apiKey = 'test';
        $this->apiSecret = 'testSecret';
        
        $this->artistClient = $this->getMock('BinaryThinking\LastfmBundle\Lastfm\Client\Method\ArtistMethodsClient', 
                array('call'), array($this->apiKey, $this->apiSecret));
    }    
    
    public function testGetCorrection()
    {
        $this->stubCallMethod('MockCorrectionArtistResponse');
        
        $corrections = $this->artistClient->getCorrection('test artist');
        
        $this->assertNotEmpty($corrections, 'no corrections retrieved');
        
        $firstCorrection = reset($corrections);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Artist', $firstCorrection, 'wrong instance of object');
    }
    
    public function testGetEvents()
    {
        $this->stubCallMethod('MockGetEventsArtistResponse');
        
        $events = $this->artistClient->getEvents('test artist');
        
        $this->assertNotEmpty($events, 'no events retrieved');
        
        $firstEvent = reset($events);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Event', $firstEvent, 'wrong instance of object');
        $this->assertNotEmpty($firstEvent->getId(), 'empty event id');
        
    }
    
    public function testGetInfo()
    {
        $this->stubCallMethod('MockGetInfoArtistResponse');
        
        $artist = $this->artistClient->getInfo('test artist');
        
        $this->assertNotEmpty($artist, 'no artist retrieved');
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Artist', $artist, 'wrong instance of object');        
    }
    
    public function testGetPastEvents()
    {
        $this->stubCallMethod('MockGetEventsArtistResponse');
        
        $events = $this->artistClient->getPastEvents('test artist');
        
        $this->assertNotEmpty($events, 'no events retrieved');
        
        $firstEvent = reset($events);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Event', $firstEvent, 'wrong instance of object');
        $this->assertNotEmpty($firstEvent->getId(), 'empty event id');
        
    }
    
    public function testGetShouts()
    {
        $this->stubCallMethod('MockGetShoutsArtistResponse');

        $shouts = $this->artistClient->getShouts('Death', 'Sound of perseverance');
        $this->assertNotEmpty($shouts, 'no shouts retrieved');
        
        $firstShout = reset($shouts);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Shout', $firstShout, 'shout is not a valid instance of Shout class');
        $this->assertEquals('Just cannot get enough', $firstShout->getBody(), 'shout does not match');
    }
    
    public function testGetTags()
    {
        $this->stubCallMethod('MockGetTagsArtistResponse');
        
        $userTags = $this->artistClient->getTags('In Flames', 'someUserName');
        $this->assertNotEmpty($userTags, 'no artist tags retrieved');
        
        $firstTag = reset($userTags);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Tag', $firstTag, 'tag is not a valid instance of Tag class');
        $this->assertEquals('swedish', $firstTag->getName(), 'tag name does not match');
    }
    
    protected function stubCallMethod($mockResponseName)
    {
        libxml_use_internal_errors(true);
        $mockResponse = simplexml_load_file(dirname(__FILE__) . '/Mock/Artist/' . $mockResponseName . '.xml');

        $this->artistClient->expects($this->any())
                ->method('call')
                ->will($this->returnValue($mockResponse));
    }    
}
