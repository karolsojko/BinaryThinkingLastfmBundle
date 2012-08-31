<?php

namespace BinaryThinking\LastfmBundle\Tests\Lastfm\Model;

use BinaryThinking\LastfmBundle\Lastfm\Model\Track;

/**
 * TrackTest
 *
 * @author Karol Sójko <karolsojko@gmail.com>
 */
class TrackTest extends ModelTestCase
{
    public function testCreateFromResponse()
    {
        $mockResponse = $this->createMockResponse('MockTrackResponse');
        $track = Track::createFromResponse($mockResponse);
        
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Track', 
                $track, 'object created is not an instance of Track');
        $this->assertNotEmpty($track->getMbid(), 'track mbid is empty');
        $this->assertNotEmpty($track->getName(), 'track name is empty');
        $this->assertNotEmpty($track->getUrl(), 'track url is empty');
        $this->assertNotEmpty($track->getArtist(), 'track artist is empty');
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Artist', 
                $track->getArtist(), 'object created is not an instance of Artist');
        $this->assertNotEmpty($track->getDuration(), 'track duration is empty');
        $this->assertNotEmpty($track->getNumber(), 'track number is empty');
        $this->assertNotEmpty($track->getStreamable(), 'track streamable is empty');
        $this->assertNotEmpty($track->getListeners(), 'track listeners is empty');
        $this->assertNotEmpty($track->getPlaycount(), 'track play count is empty');
        $this->assertNotEmpty($track->getImages(), 'track images are empty');
        $this->assertArrayHasKey('extralarge', $track->getImages(), 'track has no extralarge image');
    }
    
    public function testCreateFromPartialResponse()
    {
        $mockResponse = $this->createMockResponse('MockTrackPartialResponse');
        $track = Track::createFromResponse($mockResponse);
        
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Track', 
                $track, 'object created is not an instance of Track');
        $this->assertNotEmpty($track->getMbid(), 'track mbid is empty');
        $this->assertNotEmpty($track->getName(), 'track name is empty');
        $this->assertNotEmpty($track->getUrl(), 'track url is empty');
        $this->assertNotEmpty($track->getArtist(), 'track artist is empty');
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Artist', 
                $track->getArtist(), 'object created is not an instance of Artist');
        $this->assertNotEmpty($track->getDuration(), 'track duration is empty');
        $this->assertNotEmpty($track->getNumber(), 'track number is empty');
        $this->assertNotEmpty($track->getStreamable(), 'track streamable is empty');
    }    
    
}
