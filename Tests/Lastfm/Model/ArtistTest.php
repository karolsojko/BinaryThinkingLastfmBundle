<?php

namespace BinaryThinking\LastfmBundle\Tests\Lastfm\Model;

use BinaryThinking\LastfmBundle\Lastfm\Model\Artist;

/**
 * ArtistTest
 *
 * @author Karol Sójko <karolsojko@gmail.com>
 */
class ArtistTest extends ModelTestCase
{
    public function testCreateFromResponse()
    {
        $mockResponse = $this->createMockResponse('MockArtistResponse');
        $artist = Artist::createFromResponse($mockResponse);
        
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Artist', 
                $artist, 'object created is not an instance of Artist');
        $this->assertNotEmpty($artist->getMbid(), 'artist mbid is empty');
        $this->assertNotEmpty($artist->getName(), 'artist name is empty');
        $this->assertNotEmpty($artist->getUrl(), 'artist url is empty');
        $this->assertNotEmpty($artist->getImages(), 'artist images are empty');
        $this->assertArrayHasKey('mega', $artist->getImages(), 'artist has no mega image');
        $this->assertNotEmpty($artist->getStreamable(), 'artist streamable is empty');
        $this->assertNotEmpty($artist->getListeners(), 'artist listeners is empty');
        $this->assertNotEmpty($artist->getPlaycount(), 'artist playcount is empty');
        $this->assertNotEmpty($artist->getSimilar(), 'artist similar is empty');
        $this->assertArrayHasKey('Morbid Angel', $artist->getSimilar(), 'Morbid Angel is not in the similar artists');
        $similarArtists = $artist->getSimilar();
        $this->assertNotEmpty($similarArtists['Morbid Angel']->getImages(), 'similar artist images are empty');
        $this->assertNotEmpty($artist->getTags(), 'artist tags are empty');
        $this->assertNotEmpty($artist->getBio(), 'artist bio is empty');
    }
    
    public function testCreateFromPartialResponse()
    {
        $mockResponse = $this->createMockResponse('MockArtistPartialResponse');
        $artist = Artist::createFromResponse($mockResponse);
        
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Artist', 
                $artist, 'object created is not an instance of Artist');
        $this->assertNotEmpty($artist->getMbid(), 'artist mbid is empty');
        $this->assertNotEmpty($artist->getName(), 'artist name is empty');
        $this->assertNotEmpty($artist->getUrl(), 'artist url is empty');
    }
    
}
