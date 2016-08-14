<?php

namespace BinaryThinking\LastfmBundle\Tests\Lastfm\Client\Method;

/**
 * UserMethodsClientTest
 *
 * @author Karol Sójko <karolsojko@gmail.com>
 * @author Chris Neale [https://github.com/cdn]
 */
class UserMethodsClientTest extends MethodsClientTestCase
{
    public function setUp()
    {
        $this->context = 'User';
        parent::setUp();
    }

    public function testGetTopArtists()
    {
        $this->stubCallMethod('MockUserGetTopArtistsResponse');

        $artists = $this->client->getTopArtists('ks');
        $this->assertNotEmpty($artists, 'artist are not retrieved');

        $firstArtist = reset($artists);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Artist',
                $firstArtist, 'artist is wrong instance');
        $this->assertEquals('Coil', $firstArtist->getName(), 'wrong name of artist');
    }

    public function testGetTopAlbums()
    {
        $this->stubCallMethod('MockUserGetTopAlbumsResponse');

        $albums = $this->client->getTopAlbums('ks');
        $this->assertNotEmpty($albums, 'albums are not retrieved');

        $firstAlbum = reset($albums);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Album',
                $firstAlbum, 'album is wrong instance');
        $this->assertEquals('Love', $firstAlbum->getName(), 'wrong name of album');
    }

    public function testGetTopTracks()
    {
        $this->stubCallMethod('MockUserGetTopTracksResponse');

        $tracks = $this->client->getTopTracks('ks');
        $this->assertNotEmpty($tracks, 'tracks are not retrieved');

        $firstTrack = reset($tracks);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Track',
                $firstTrack, 'track is wrong instance');
        $this->assertEquals('Moonlight', $firstTrack->getName(), 'wrong name of track');
    }

    public function testGetInfo()
    {
        $this->stubCallMethod('MockUserGetInfoResponse');

        $user = $this->client->getInfo('cdn');
        $this->assertNotEmpty($user, 'user info not retrieved');

        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\User',
                $user, 'user is wrong instance');
        $this->assertEquals(100416, $user->getPlayCount(), 'wrong playcount for user');
    }

    public function testGetTopTags()
    {
        $this->stubCallMethod('MockUserGetTopTagsResponse');

        $tags = $this->client->getTopTags('ks');
        $this->assertNotEmpty($tags, 'top tags not retrieved');

        $firstTag = reset($tags);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Tag',
                $firstTag, 'tag is wrong instance');
        $this->assertEquals('autechre-like', $firstTag->getName(), 'wrong name of tag');
    }

    public function testGetWeeklyAlbumChart()
    {
        $this->stubCallMethod('MockUserGetWeeklyAlbumChartResponse');

        $albums = $this->client->getWeeklyAlbumChart('cdn');
        $this->assertNotEmpty($albums, 'albums not retrieved');

        $firstAlbum = reset($albums);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Album',
                $firstAlbum, 'album is wrong instance');
        $this->assertEquals('Live and Let Die', $firstAlbum->getName(), 'wrong name of album');
    }

    public function testGetWeeklyArtistChart()
    {
        $this->stubCallMethod('MockUserGetWeeklyArtistChartResponse');

        $artists = $this->client->getWeeklyArtistChart('cdn');
        $this->assertNotEmpty($artists, 'artists not retrieved');

        $firstArtist = reset($artists);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Artist',
                $firstArtist, 'artist is wrong instance');
        $this->assertEquals('John Barry', $firstArtist->getName(), 'wrong name of artist');
    }

    public function testGetWeeklyChartList()
    {
        $this->stubCallMethod('MockUserGetWeeklyChartListResponse');

        $charts = $this->client->getWeeklyChartList('ks');
        $this->assertNotEmpty($charts, 'charts not retrieved');

        $firstChart = reset($charts);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Chart',
                $firstChart, 'artist is wrong instance');
        $this->assertEquals(1108296000, $firstChart->getFrom(), 'wrong from date');
        $this->assertEquals(1108900800, $firstChart->getTo(), 'wrong to date');
    }

    public function testGetWeeklyTrackChart()
    {
        $this->stubCallMethod('MockUserGetWeeklyTrackChartResponse');

        $tracks = $this->client->getWeeklyTrackChart('cdn');
        $this->assertNotEmpty($tracks, 'tracks not retrieved');

        $firstTrack = reset($tracks);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Track',
                $firstTrack, 'track is wrong instance');
        $this->assertEquals('Bacoa', $firstTrack->getName(), 'wrong name of track');
    }

}
