<?php

namespace BinaryThinking\LastfmBundle\Tests\Lastfm\Model;

use BinaryThinking\LastfmBundle\Lastfm\Model\Track;

/**
 * TrackTest
 *
 * @author Karol Sójko <karolsojko@gmail.com>
 */
class TrackTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateFromResponse()
    {
        $mockResponse = $this->createMockTrackResponse();
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
    
    protected function createMockTrackResponse()
    {
        libxml_use_internal_errors(true);
        $mockResponse = simplexml_load_file(dirname(__FILE__) . '/Mock/MockTrackResponse.xml');
        
        return $mockResponse;
    }        
}
