<?php

namespace BinaryThinking\LastfmBundle\Tests\Lastfm\Model;

use BinaryThinking\LastfmBundle\Lastfm\Model\Tag;

/**
 * TagTest
 *
 * @author Karol Sójko <karolsojko@gmail.com>
 */
class TagTest extends ModelTestCase
{
    public function testCreateFromResponse()
    {
        $mockResponse = $this->createMockResponse('MockTagResponse');
        $tag = Tag::createFromResponse($mockResponse);
        
        $this->assertNotEmpty($tag->getName(), 'tag has empty name');
        $this->assertNotEmpty($tag->getCount(), 'tag has empty count');
        $this->assertNotEmpty($tag->getUrl(), 'tag has empty url');
    }
    
    public function testCreateFromGetInfoResponse()
    {
        $mockResponse = $this->createMockResponse('MockTagGetInfoResponse');
        $tag = Tag::createFromResponse($mockResponse);
        
        $this->assertNotEmpty($tag->getName(), 'tag has empty name');
        $this->assertNotEmpty($tag->getUrl(), 'tag has empty url');
        $this->assertNotEmpty($tag->getReach(), 'tag has empty reach');
        $this->assertNotEmpty($tag->getTaggings(), 'tag has empty taggings');
        $this->assertNotEmpty($tag->getStreamable(), 'tag has empty streamable');
        $this->assertNotEmpty($tag->getPublished(), 'tag has empty published');
        $this->assertNotEmpty($tag->getSummary(), 'tag has empty summary');
        $this->assertNotEmpty($tag->getContent(), 'tag has empty content');
    }    
    
}
