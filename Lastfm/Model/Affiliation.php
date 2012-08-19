<?php

namespace BinaryThinking\LastfmBundle\Lastfm\Model;

/**
 * Affiliation
 *
 * @author Karol Sójko <karolsojko@gmail.com>
 */
class Affiliation implements LastfmModelInterface
{
    protected $supplierName;
    
    protected $price;
    
    protected $buyLink;
    
    protected $supplierIcon;
    
    protected $isSearch;
    
    public static function createFromResponse(\SimpleXMLElement $response)
    {
        $affiliation = new Affiliation();
        $affiliation->setSupplierName((string) $response->supplierName);
        $price = array();
        $price['currency'] = (string) $response->price->currency;
        $price['amount'] = (double) $response->price->amount;
        $affiliation->setPrice($price);
        $affiliation->setBuyLink((string) $response->buyLink);
        $affiliation->setSupplierIcon((string) $response->supplierIcon);
        $affiliation->setIsSearch((bool) $response->isSearch);
        
        return $affiliation;
    }
    
    public function getSupplierName()
    {
        return $this->supplierName;
    }

    public function setSupplierName($supplierName)
    {
        $this->supplierName = $supplierName;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getBuyLink()
    {
        return $this->buyLink;
    }

    public function setBuyLink($buyLink)
    {
        $this->buyLink = $buyLink;
    }

    public function getSupplierIcon()
    {
        return $this->supplierIcon;
    }

    public function setSupplierIcon($supplierIcon)
    {
        $this->supplierIcon = $supplierIcon;
    }

    public function getIsSearch()
    {
        return $this->isSearch;
    }

    public function setIsSearch($isSearch)
    {
        $this->isSearch = $isSearch;
    }

}
