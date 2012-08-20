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
    
    protected function stubCallMethod($mockResponseName)
    {
        libxml_use_internal_errors(true);
        $mockResponse = simplexml_load_file(dirname(__FILE__) . '/Mock/Artist/' . $mockResponseName . '.xml');

        $this->artistClient->expects($this->any())
                ->method('call')
                ->will($this->returnValue($mockResponse));
    }    
}
