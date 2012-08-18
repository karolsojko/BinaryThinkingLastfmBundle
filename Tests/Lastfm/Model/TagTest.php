<?php

namespace BinaryThinking\LastfmBundle\Tests\Lastfm\Model;

use BinaryThinking\LastfmBundle\Lastfm\Model\Tag;

/**
 * TagTest
 *
 * @author Karol Sójko <karolsojko@gmail.com>
 */
class TagTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateFromResponse()
    {
        $mockResponse = $this->createMockTagResponse();
        $tag = Tag::createFromResponse($mockResponse);
        
        $this->assertNotEmpty($tag->getName(), 'tag has empty name');
        $this->assertNotEmpty($tag->getCount(), 'tag has empty count');
        $this->assertNotEmpty($tag->getUrl(), 'tag has empty url');
    }
    
    protected function createMockTagResponse()
    {
        libxml_use_internal_errors(true);
        $mockResponse = simplexml_load_file(dirname(__FILE__) . '/Mock/MockTagResponse.xml');
        return $mockResponse;
    }    
}
