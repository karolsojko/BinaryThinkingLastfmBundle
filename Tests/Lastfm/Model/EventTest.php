<?php

namespace BinaryThinking\LastfmBundle\Tests\Lastfm\Model;

use BinaryThinking\LastfmBundle\Lastfm\Model\Event;

/**
 * EventTest
 *
 * @author Karol Sójko <karolsojko@gmail.com>
 */
class EventTest extends ModelTestCase 
{
    public function testCreateFromResponse()
    {
        $mockResponse = $this->createMockResponse('MockEventResponse');
        $event = Event::createFromResponse($mockResponse);
        
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Event', 
                $event, 'object created is not an instance of Event');
        
        $this->assertNotEmpty($event->getId(), 'empty event id');
        $this->assertNotEmpty($event->getTitle(), 'empty event title');
        $this->assertNotEmpty($event->getArtists(), 'empty event artists');
        $this->assertNotEmpty($event->getHeadliner(), 'empty event headliner');
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Venue', $event->getVenue(), 'wrong instance for venue');
        $this->assertNotEmpty($event->getStartDate(), 'empty event start date');
        $this->assertNotEmpty($event->getDescription(), 'empty event description');
        $this->assertNotEmpty($event->getImages(), 'empty event images');
        $this->assertArrayHasKey('extralarge', $event->getImages(), 'empty event extralarge image');
        $this->assertNotEmpty($event->getAttendance(), 'empty event attendance');
        $this->assertNotEmpty($event->getReviews(), 'empty event reviews');
        $this->assertNotEmpty($event->getEventTag(), 'empty event tag');
        $this->assertNotEmpty($event->getUrl(), 'empty event url');
        $this->assertNotEmpty($event->getWebsite(), 'empty event website');
        $this->assertNotEmpty($event->getTickets(), 'empty event tickets');
        $this->assertEquals(0, $event->getCancelled(), 'event is cancelled');
    }
}
