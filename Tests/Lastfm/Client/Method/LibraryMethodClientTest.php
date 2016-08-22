<?php

namespace BinaryThinking\LastfmBundle\Tests\Lastfm\Client\Method;

/**
 * ChartMethodsClientTest
 *
 * @author Chris Neale [https://github.com/cdn]
 */
class LibraryMethodClientTest extends MethodsClientTestCase
{
    public function setUp()
    {
        $this->context = 'Library';
        parent::setUp();
    }

    public function testGetArtists()
    {
        $this->stubCallMethod('MockLibraryGetArtistsResponse');

        $artists = $this->client->getArtists('cdn');
        $this->assertNotEmpty($artists, 'artists are not retrieved');

        $firstArtist = reset($artists);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Artist',
                $firstArtist, 'artist is wrong instance');
        $this->assertEquals('Henry Mancini', $firstArtist->getName(), 'wrong name of artist');
    }
}
