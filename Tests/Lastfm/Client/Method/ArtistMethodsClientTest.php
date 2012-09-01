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

        $shouts = $this->artistClient->getShouts('Death');
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
    
    public function testGetTopTags()
    {
        $this->stubCallMethod('MockGetTopTagsArtistResponse');
        
        $topTags = $this->artistClient->getTopTags('In Flames');
        $this->assertNotEmpty($topTags, 'no artist tags retrieved');
        
        $firstTag = reset($topTags);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Tag', $firstTag, 'tag is not a valid instance of Tag class');
        $this->assertEquals('swedish', $firstTag->getName(), 'tag name does not match');
    }
    
    public function testGetSimilar()
    {
        $this->stubCallMethod('MockGetSimilarArtistResponse');
        
        $similarArtists = $this->artistClient->getSimilar('Cher');
        $this->assertNotEmpty($similarArtists, 'no similar artists retrieved');
        
        $this->assertCount(2, $similarArtists, 'wrong number of artists retrieved');
        $firstArtist = reset($similarArtists);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Artist', $firstArtist, 'artist is not a valid instance of Artist class');
        $this->assertEquals('Sonny & Cher', $firstArtist->getName(), 'artist name does not match');
    }
    
    public function testGetTopAlbums()
    {
        $this->stubCallMethod('MockGetTopAlbumsArtistResponse');
        
        $topAlbums = $this->artistClient->getTopAlbums('Cher');
        $this->assertNotEmpty($topAlbums, 'no top albums retrieved');
        
        $this->assertCount(2, $topAlbums, 'wrong number of albums retrieved');
        $firstAlbum = reset($topAlbums);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Album', $firstAlbum, 'album is not a valid instance of Album class');
        $this->assertEquals('The Very Best of Cher', $firstAlbum->getName(), 'album name does not match');
        $this->assertEquals(111524, $firstAlbum->getPlayCount(), 'playcount does not match');
    }
    
    public function testGetTopTracks()
    {
        $this->stubCallMethod('MockGetTopTracksArtistResponse');
        
        $topTracks = $this->artistClient->getTopTracks('Cradle of filth');
        $this->assertNotEmpty($topTracks, 'no top tracks retrieved');
        
        $firstTrack = reset($topTracks);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Track', $firstTrack, 'tracks is not a valid instance of Track class');
        $this->assertEquals('Her Ghost In The Fog', $firstTrack->getName(), 'track name does not match');
        $this->assertEquals(384, $firstTrack->getDuration(), 'duration does not match');
    }
    
    public function testSearch()
    {
        $this->stubCallMethod('MockSearchArtistResponse');
        
        $searchedArtists = $this->artistClient->search('Death');
        $this->assertNotEmpty($searchedArtists, 'no artists retrieved');
        
        $firstArtist = reset($searchedArtists);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Artist', $firstArtist, 'artist is not a valid instance of Artist class');
        $this->assertEquals('Death Cab for Cutie', $firstArtist->getName(), 'artist name does not match');
        $this->assertEquals(2356401, $firstArtist->getListeners(), 'listeners does not match');
    }
    
    public function testGetTopFans()
    {
        $this->stubCallMethod('MockGetTopFansArtistResponse');
        
        $topFans = $this->artistClient->getTopFans('Death');
        $this->assertNotEmpty($topFans, 'top fans are not retrieved');
        
        $firstFan = reset($topFans);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\User', $firstFan, 'fan is not a valid instance of User class');
        $this->assertEquals(56897108, $firstFan->getWeight(), 'wieght does not match');
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
