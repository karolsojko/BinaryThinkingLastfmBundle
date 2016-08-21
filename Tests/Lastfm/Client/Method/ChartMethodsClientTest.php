<?php

namespace BinaryThinking\LastfmBundle\Tests\Lastfm\Client\Method;

/**
 * ChartMethodsClientTest
 *
 * @author Chris Neale [https://github.com/cdn]
 */
class ChartMethodsClientTest extends MethodsClientTestCase
{
    public function setUp()
    {
        $this->context = 'Chart';
        parent::setUp();
    }

    public function testGetTopArtists()
    {
        $this->stubCallMethod('MockChartGetTopArtistsResponse');

        $artists = $this->client->getTopArtists();
        $this->assertNotEmpty($artists, 'artists are not retrieved');

        $firstArtist = reset($artists);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Artist',
                $firstArtist, 'artist is wrong instance');
        $this->assertEquals('Coldplay', $firstArtist->getName(), 'wrong name of artist');
    }

    public function testGetTopTags()
    {
        $this->stubCallMethod('MockChartGetTopTagsResponse');

        $tags = $this->client->getTopTags();
        $this->assertNotEmpty($tags, 'top tags not retrieved');

        $firstTag = reset($tags);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Tag',
                $firstTag, 'tag is wrong instance');
        $this->assertEquals('rock', $firstTag->getName(), 'wrong name of tag');
    }

    public function testGetTopTracks()
    {
        $this->stubCallMethod('MockChartGetTopTracksResponse');

        $tracks = $this->client->getTopTracks();
        $this->assertNotEmpty($tracks, 'tracks are not retrieved');

        $firstTrack = reset($tracks);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Track',
                $firstTrack, 'track is wrong instance');
        $this->assertEquals('Cheap Thrills', $firstTrack->getName(), 'wrong name of track');
    }
}
