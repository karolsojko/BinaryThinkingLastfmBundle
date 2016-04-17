<?php

namespace BinaryThinking\LastfmBundle\Tests\Lastfm\Client\Method;

use BinaryThinking\LastfmBundle\Lastfm\Model\Artist;
use BinaryThinking\LastfmBundle\Lastfm\Model\Geo;
use BinaryThinking\LastfmBundle\Lastfm\Model\Track;

/**
 * GeoMethodsClientTest
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class GeoMethodsClientTest extends MethodsClientTestCase
{
    public function setUp()
    {
        $this->context = 'Geo';
        parent::setUp();
    }

    public function testGetTopArtists()
    {
        $this->stubCallMethod('MockGeoTopArtistsResponse');

        /** @var Geo $geo */
        $geo = $this->client->getTopArtists('Ukraine');
        $this->assertNotEmpty($geo, 'Geo is empty');

        $this->assertCount(1, $geo->getArtists(), 'wrong number of artists retrieved');

        /** @var Artist[] $artists */
        $artists = $geo->getArtists();
        /** @var Artist $firstArtist */
        $firstArtist = $artists['Radiohead'];

        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Artist', $firstArtist, 'artist is not a valid instance of Artist class');
        $this->assertEquals('Radiohead', $firstArtist->getName(), 'artist name does not match');
        $this->assertEquals(4453470, $firstArtist->getListeners(), 'playcount does not match');
    }

    public function testGetTopTracks()
    {
        $this->stubCallMethod('MockGeoTopTracksResponse');

        /** @var Geo $geo */
        $geo = $this->client->getTopTracks('Ukraine');
        $this->assertNotEmpty($geo, 'Geo is empty');

        $this->assertCount(1, $geo->getTracks(), 'wrong number of artists retrieved');

        /** @var Track[] $tracks */
        $tracks = $geo->getTracks();
        /** @var Track $firstTrack */
        $firstTrack = $tracks['Do I Wanna Know?'];

        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Track', $firstTrack, 'track is not a valid instance of Track class');
        $this->assertEquals('Do I Wanna Know?', $firstTrack->getName(), 'track name does not match');
        $this->assertEquals(272, $firstTrack->getDuration(), 'track duration does not match');
        $this->assertEquals(699053, $firstTrack->getListeners(), 'track listeners does not match');
    }
}
