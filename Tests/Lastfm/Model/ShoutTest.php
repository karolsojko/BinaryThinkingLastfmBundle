<?php

namespace BinaryThinking\LastfmBundle\Tests\Lastfm\Model;

use BinaryThinking\LastfmBundle\Lastfm\Model\Shout;

/**
 * ShoutTest
 *
 * @author Karol Sójko <karolsojko@gmail.com>
 */
class ShoutTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateFromResponse()
    {
        $mockResponse = $this->createMockArtistResponse();
        $shout = Shout::createFromResponse($mockResponse);
        
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Shout', 
                $shout, 'object created is not an instance of Shout');
        $this->assertNotEmpty($shout->getAuthor(), 'shout author is empty');
        $this->assertNotEmpty($shout->getBody(), 'shout body is empty');
        $this->assertNotEmpty($shout->getDate(), 'shout date is empty');
    }
    
    protected function createMockArtistResponse()
    {
        libxml_use_internal_errors(true);
        $mockResponse = simplexml_load_file(dirname(__FILE__) . '/Mock/MockShoutResponse.xml');
        return $mockResponse;
    }
}
