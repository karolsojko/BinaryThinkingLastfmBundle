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
    
}
