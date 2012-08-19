<?php

namespace BinaryThinking\LastfmBundle\Tests\Lastfm\Model;

use BinaryThinking\LastfmBundle\Lastfm\Model\Affiliation;

/**
 * AffiliationTest
 *
 * @author Karol Sójko <karolsojko@gmail.com>
 */
class AffiliationTest extends \PHPUnit_Framework_TestCase 
{
    public function testCreateFromResponse()
    {
        $mockResponse = $this->createMockAffiliationResponse();
        $affiliation = Affiliation::createFromResponse($mockResponse);
        
        $this->assertInstanceOf('BinaryThinking\LastfmBundle\Lastfm\Model\Affiliation', 
                $affiliation, 'object created is not an instance of Affiliation');
        $this->assertNotEmpty($affiliation->getSupplierName(), 'empty affiliation supplier name');
        $this->assertNotEmpty($affiliation->getPrice(), 'empty affiliation price');
        $this->assertNotEmpty($affiliation->getSupplierIcon(), 'empty affiliation supplier icon');
        $this->assertNotEmpty($affiliation->getIsSearch(), 'empty affiliation is search');
        $this->assertNotEmpty($affiliation->getBuyLink(), 'empty affiliation buy link');
    }
    
    protected function createMockAffiliationResponse()
    {
        libxml_use_internal_errors(true);
        $mockResponse = simplexml_load_file(dirname(__FILE__) . '/Mock/MockAffiliationResponse.xml');
        
        return $mockResponse;
    }    
}
