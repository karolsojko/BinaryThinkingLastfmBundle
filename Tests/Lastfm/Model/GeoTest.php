<?php

namespace BinaryThinking\LastfmBundle\Tests\Lastfm\Model;

use BinaryThinking\LastfmBundle\Lastfm\Model\Album;
use BinaryThinking\LastfmBundle\Lastfm\Model\Geo;

/**
 * GeoTest
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class GeoTest extends ModelTestCase
{
    public function testCreateFromArtistsResponse()
    {
        $mockResponse = $this->createMockResponse('MockGeoTopArtistsResponse');
        $geo          = Geo::createFromResponse($mockResponse);

        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Geo',
            $geo, 'object created is not an instance of Geo');

        $artist = $geo->getArtists()['Radiohead'];

        $this->assertNotEmpty($artist->getMbid(), 'artist mbid is empty');
        $this->assertNotEmpty($artist->getName(), 'artist name is empty');
        $this->assertNotEmpty($artist->getUrl(), 'artist url is empty');
        $this->assertNotEmpty($artist->getImages(), 'artist images are empty');
        $this->assertArrayHasKey('mega', $artist->getImages(), 'artist has no mega image');
        $this->assertEquals(0, $artist->getStreamable(), 'artist streamable not equal 0');
        $this->assertNotEmpty($artist->getListeners(), 'artist listeners is empty');
    }

    public function testCreateFromTracksResponse()
    {
        $mockResponse = $this->createMockResponse('MockGeoTopTracksResponse');
        $geo          = Geo::createFromResponse($mockResponse);

        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Geo',
            $geo, 'object created is not an instance of Geo');

        $track = $geo->getTracks()['Do I Wanna Know?'];
        $this->assertNotEmpty($track->getMbid(), 'track mbid is empty');
        $this->assertNotEmpty($track->getName(), 'track name is empty');
        $this->assertNotEmpty($track->getUrl(), 'track url is empty');
        $this->assertNotEmpty($track->getImages(), 'track images are empty');
        $this->assertArrayHasKey('extralarge', $track->getImages(), 'track has no mega image');
        $this->assertEquals(0, $track->getStreamable(), 'track streamable not equal 0');
        $this->assertNotEmpty($track->getListeners(), 'track listeners is empty');
        $this->assertNotEmpty($track->getDuration(), 'track duration is empty');
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Artist',
            $track->getArtist(), 'object created is not an instance of Artist');
    }
}
