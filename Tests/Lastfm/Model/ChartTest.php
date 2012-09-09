<?php

namespace BinaryThinking\LastfmBundle\Tests\Lastfm\Model;

use BinaryThinking\LastfmBundle\Lastfm\Model\Chart;

/**
 * ChartTest
 *
 * @author Karol Sójko <karolsojko@gmail.com>
 */
class ChartTest extends ModelTestCase
{
    public function testCreateFromResponse()
    {
        $mockResponse = $this->createMockResponse('MockChartResponse');
        $chart = Chart::createFromResponse($mockResponse);
        
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Chart', 
                $chart, 'object created is not an instance of Chart');
        $this->assertNotEmpty($chart->getFrom(), 'from is empty');
        $this->assertNotEmpty($chart->getTo(), 'to is empty');
    }
}
