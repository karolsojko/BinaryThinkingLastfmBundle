<?php

namespace BinaryThinking\LastfmBundle\Tests\Lastfm\Model;

use BinaryThinking\LastfmBundle\Lastfm\Model\Album;

/**
 * AlbumTest
 *
 * @author Karol Sójko <karolsojko@gmail.com>
 */
class AlbumTest extends \PHPUnit_Framework_TestCase
{
    
    public function testCreateFromResponse()
    {
        $mockResponse = $this->createMockAlbumResponse();
        $album = Album::createFromResponse($mockResponse);
        
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Album', 
                $album, 'object created is not an instance of Album');
        $this->assertNotEmpty($album->getId(), 'empty album id');
        $this->assertNotEmpty($album->getName(), 'empty album name');
        $this->assertNotEmpty($album->getArtist(), 'empty album artist');
        $this->assertNotEmpty($album->getUrl(), 'empty album url');
        $this->assertNotEmpty($album->getMbid(), 'empty album mbid');
        $this->assertNotEmpty($album->getReleaseDate(), 'empty album release date');
        $this->assertNotEmpty($album->getListeners(), 'empty album listeners');
        $this->assertNotEmpty($album->getPlayCount(), 'empty album play count');
        $this->assertNotEmpty($album->getImages(), 'empty album images');
        $this->assertNotEmpty($album->getStreamable(), 'empty album streamable');
        $this->assertNotEmpty($album->getTopTags(), 'empty album top tags');
        $this->assertNotEmpty($album->getTracks(), 'empty album tracks');
    }
    
    protected function createMockAlbumResponse()
    {
        libxml_use_internal_errors(true);
        $mockResponse = simplexml_load_file(dirname(__FILE__) . '/Mock/MockAlbumResponse.xml');
        return $mockResponse;
    }
    
}
