<?php

namespace BinaryThinking\LastfmBundle\Lastfm\Model;

/**
 * LastfmModelInterface
 * 
 * @author Karol Sójko <karolsojko@gmail.com>
 */
interface LastfmModelInterface {

    public static function createFromResponse(\SimpleXMLElement $response);
    
}
