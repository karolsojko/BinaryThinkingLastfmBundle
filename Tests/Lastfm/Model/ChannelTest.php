<?php

namespace BinaryThinking\LastfmBundle\Tests\Lastfm\Model;

use BinaryThinking\LastfmBundle\Lastfm\Model\Channel;

/**
 * ChannelTest
 *
 * @author Karol Sójko <karolsojko@gmail.com>
 */
class ChannelTest extends ModelTestCase
{
    
    public function testCreateFromResponse()
    {
        $mockResponse = $this->createMockResponse('MockChannelResponse');
        $channel = Channel::createFromResponse($mockResponse);
        
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Channel', 
                $channel, 'object created is not an instance of Channel');
        $this->assertNotEmpty($channel->getTitle(), 'title is empty');
        $this->assertNotEmpty($channel->getLink(), 'link is empty');
        $this->assertNotEmpty($channel->getDescription(), 'description is empty');
        $this->assertNotEmpty($channel->getItems(), 'items are empty');
    }
    
}
