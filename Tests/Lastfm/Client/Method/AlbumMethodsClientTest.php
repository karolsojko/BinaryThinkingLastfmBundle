<?php

namespace BinaryThinking\LastfmBundle\Tests\Lastfm\Client\Method;

/**
 * AlbumMethodsClientTest
 *
 * @author Karol Sójko <karolsojko@gmail.com>
 */
class AlbumMethodsClientTest extends MethodsClientTestCase
{
    
    public function setUp()
    {
        $this->context = 'Album';
        parent::setUp();
    }
    
    public function testSearch()
    {
        $this->stubCallMethod('MockSearchAlbumResponse');
        
        $albums = $this->client->search('Sound of perseverance');
        $this->assertNotEmpty($albums, 'no albums retrieved');
        
        $firstAlbum = reset($albums);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Album', $firstAlbum, 'album is not a valid instance of Album class');
        $this->assertEquals('Death', $firstAlbum->getArtist()->getName(), 'artist does not match');
    }
    
    public function testGetTopTags()
    {
        $this->stubCallMethod('MockGetTopTagsAlbumResponse');
        
        $topTags = $this->client->getTopTags('Cynic', 'Focus');
        $this->assertNotEmpty($topTags, 'no album tags retrieved');
        
        $firstTag = reset($topTags);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Tag', $firstTag, 'tag is not a valid instance of Tag class');
        $this->assertEquals('albums I own', $firstTag->getName(), 'tag name does not match');
    }
    
    public function testGetTags()
    {
        $this->stubCallMethod('MockGetTagsAlbumResponse');
        
        $userTags = $this->client->getTags('In Flames', 'Sounds of a playground fading', 'someUserName');
        $this->assertNotEmpty($userTags, 'no album tags retrieved');
        
        $firstTag = reset($userTags);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Tag', $firstTag, 'tag is not a valid instance of Tag class');
        $this->assertEquals('swedish', $firstTag->getName(), 'tag name does not match');
    }
    
    public function testGetInfo()
    {
        $this->stubCallMethod('MockGetInfoAlbumResponse');

        $album = $this->client->getInfo('Death', 'Sound of perseverance');
        $this->assertNotEmpty($album, 'no album retrieved');
        
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Album', $album, 'album is not a valid instance of Album class');
        $this->assertEquals('Death', $album->getArtist()->getName(), 'artist does not match');
        $this->assertCount(9, $album->getTracks(), 'wrong number of tracks retrieved');
    }
    
    public function testGetShouts()
    {
        $this->stubCallMethod('MockGetShoutsAlbumResponse');

        $shouts = $this->client->getShouts('Death', 'Sound of perseverance');
        $this->assertNotEmpty($shouts, 'no shouts retrieved');
        
        $firstShout = reset($shouts);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Shout', $firstShout, 'shout is not a valid instance of Shout class');
        $this->assertEquals('Just cannot get enough', $firstShout->getBody(), 'shout does not match');
    }    
    
    public function testGetBuylinks()
    {
        $this->stubCallMethod('MockGetBuylinksAlbumResponse');
        
        $affiliations = $this->client->getBuylinks('TestArtist', 'test album');
        $this->assertNotEmpty($affiliations, 'no affiliations retrieved');
        
        $this->assertNotEmpty($affiliations['physicals'], 'no physical affiliations retrieved');
        $this->assertNotEmpty($affiliations['downloads'], 'no downloadable affiliations retrieved');
        
        $firstPhysical = reset($affiliations['physicals']);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Affiliation', $firstPhysical, 'wrong instance of affiliation');
        $this->assertEquals('Amazon', $firstPhysical->getSupplierName(), 'wrong supplier name');
        
        $firstDownloadable = reset($affiliations['downloads']);
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Affiliation', $firstDownloadable, 'wrong instance of affiliation');
        $this->assertEquals('Amazon MP3', $firstDownloadable->getSupplierName(), 'wrong supplier name');
    }
    
}
