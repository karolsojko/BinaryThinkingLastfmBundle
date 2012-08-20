<?php

namespace BinaryThinking\LastfmBundle\Tests\Lastfm\Model;

/**
 * AbstractModelTest
 *
 * @author Karol Sójko <karolsojko@gmail.com>
 */
abstract class ModelTestCase extends \PHPUnit_Framework_TestCase
{
    protected function createMockResponse($mockName)
    {
        libxml_use_internal_errors(true);
        $mockResponse = simplexml_load_file(dirname(__FILE__) . '/Mock/' . $mockName . '.xml');
        
        return $mockResponse;
    }    
}
