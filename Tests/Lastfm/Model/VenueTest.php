<?php

namespace BinaryThinking\LastfmBundle\Tests\Lastfm\Model;

use BinaryThinking\LastfmBundle\Lastfm\Model\Venue;

/**
 * VenueTest
 *
 * @author Karol Sójko <karolsojko@gmail.com>
 */
class VenueTest extends ModelTestCase
{
    public function testCreateFromResponse()
    {
        $mockResponse = $this->createMockResponse('MockVenueResponse');
        $venue = Venue::createFromResponse($mockResponse);
        
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Venue', 
                $venue, 'object created is not an instance of Venue');
        
        $this->assertNotEmpty($venue->getId(), 'empty venue id');
        $this->assertNotEmpty($venue->getName(), 'empty venue name');
        $this->assertNotEmpty($venue->getLocation(), 'empty venue name');
        $geoPoint = $venue->getGeoPoint();
        $this->assertNotEmpty($geoPoint, 'empty venue geo point');
        $this->assertNotEmpty($geoPoint['lat'], 'empty venue geo point lat');
        $this->assertNotEmpty($geoPoint['long'], 'empty venue geo point long');
        $this->assertNotEmpty($venue->getUrl(), 'empty venue url');
        $this->assertNotEmpty($venue->getWebsite(), 'empty venue website');
        $this->assertNotEmpty($venue->getPhoneNumber(), 'empty venue phone number');
        $this->assertNotEmpty($venue->getImages(), 'empty venue images');
        $this->assertCount(5, $venue->getImages(), 'wrong number of images parsed');
    }
    
}
