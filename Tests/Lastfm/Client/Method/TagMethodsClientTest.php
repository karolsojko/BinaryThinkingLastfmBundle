<?php

namespace BinaryThinking\LastfmBundle\Tests\Lastfm\Client\Method;

/**
 * TagMethodsClientTest
 *
 * @author Karol Sójko <karolsojko@gmail.com>
 */
class TagMethodsClientTest extends MethodsClientTestCase
{
    public function setUp()
    {
        $this->context = 'Tag';
        parent::setUp();
    }
    
    public function testGetTopArtists()
    {
        $this->stubCallMethod('MockTagGetTopArtistsResponse');
        
        $artists = $this->client->getTopArtists('Death Metal');
        $this->assertNotEmpty($artists, 'artist are not retrieved');
        
        $firstArtist = reset($artists);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Artist',
                $firstArtist, 'artist is wrong instance');
        $this->assertEquals('Cannibal Corpse', $firstArtist->getName(), 'wrong name of artist');
    }
    
    public function testGetTopAlbums()
    {
        $this->stubCallMethod('MockTagGetTopAlbumsResponse');
        
        $albums = $this->client->getTopAlbums('Death Metal');
        $this->assertNotEmpty($albums, 'albums are not retrieved');
        
        $firstAlbum = reset($albums);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Album',
                $firstAlbum, 'album is wrong instance');
        $this->assertEquals('Scream Bloody Gore', $firstAlbum->getName(), 'wrong name of album');
    }
}