<?php

namespace BinaryThinking\LastfmBundle\Tests\Lastfm\Model;

use BinaryThinking\LastfmBundle\Lastfm\Model\Artist;

/**
 * ArtistTest
 *
 * @author Karol Sójko <karolsojko@gmail.com>
 */
class ArtistTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateFromResponse()
    {
        $mockResponse = $this->createMockArtistResponse();
        $artist = Artist::createFromResponse($mockResponse);
        
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Artist', 
                $artist, 'object created is not an instance of Artist');
        $this->assertNotEmpty($artist->getMbid(), 'artist mbid is empty');
        $this->assertNotEmpty($artist->getName(), 'artist name is empty');
        $this->assertNotEmpty($artist->getUrl(), 'artist url is empty');
    }
    
    protected function createMockArtistResponse()
    {
        libxml_use_internal_errors(true);
        $mockResponse = simplexml_load_file(dirname(__FILE__) . '/Mock/MockArtistResponse.xml');
        
        return $mockResponse;
    }    
}
