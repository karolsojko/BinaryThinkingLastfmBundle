<?php

namespace BinaryThinking\LastfmBundle\Lastfm\Model;

/**
 * Chart
 *
 * @author Karol Sójko <karolsojko@gmail.com>
 */
class Chart implements LastfmModelInterface
{
    
    protected $from;
    
    protected $to;
    
    public static function createFromResponse(\SimpleXMLElement $response)
    {
        $chart = new Chart();
        $chart->setFrom((int) $response->attributes()->from);
        $chart->setTo((int) $response->attributes()->to);
        
        return $chart;
    }
    
    public function getFrom()
    {
        return $this->from;
    }

    public function setFrom($from)
    {
        $this->from = $from;
    }

    public function getTo()
    {
        return $this->to;
    }

    public function setTo($to)
    {
        $this->to = $to;
    }

}
