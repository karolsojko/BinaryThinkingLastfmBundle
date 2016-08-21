<?php

namespace BinaryThinking\LastfmBundle\Lastfm\Client;

/**
 * LastfmAPIClient
 *
 * @author Karol Sójko <karolsojko@gmail.com>
 */
abstract class LastfmAPIClient
{

    const API_ROOT_URL = 'http://ws.audioscrobbler.com/2.0/';
    const RESPONSE_STATUS_OK = 'ok';
    const RESPONSE_STATUS_FAILED = 'failed';

    protected $apiKey;

    protected $apiSecret;

    protected $cURL;

    public function __construct($apiKey, $apiSecret)
    {
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;

        $this->cURL = curl_init();

        curl_setopt($this->cURL, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($this->cURL, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->cURL, CURLOPT_USERAGENT, 'BinaryThinkingLastfmBundle for Symfony');
        curl_setopt($this->cURL, CURLOPT_URL, self::API_ROOT_URL);
        curl_setopt($this->cURL, CURLOPT_POST, 1);
    }

    public function __destruct() {
        curl_close($this->cURL);
    }


    /**
     * @codeCoverageIgnore cURL responses are stubbed in tests
     */
    protected function call(array $params = array())
    {
        $params['api_key'] = $this->apiKey;
        $httpQuery = http_build_query($params);
        curl_setopt($this->cURL, CURLOPT_POSTFIELDS, $httpQuery);
        $cURLResponse = curl_exec($this->cURL);

        if (preg_match('/\.search$/', $params['method'])) {
            $cURLResponse = $this->checkSearchResponse($cURLResponse);
        }

        $response = new \SimpleXMLElement($cURLResponse);

        $this->validateResponse($response);

        return $response;
    }

    private function checkSearchResponse($cURLResponse)
    {
        // fix for malformed returned <type>.search xml from API
        // substitute xml header
        $header = '<results';
        $namespaced_header = '<results xmlns:opensearch="http://a9.com/-/spec/opensearch/1.1/"';
        if (!preg_match('/xmlns\:opensearch/', $cURLResponse)) {
            $cURLResponse = str_replace($header, $namespaced_header,
                                        $cURLResponse);
        }
        return $cURLResponse;
    }

    /**
     * @codeCoverageIgnore since only called from ignored call method
     */
    protected function validateResponse(\SimpleXMLElement $response)
    {
        $responseAttributes = $response->attributes();
        if(isset($responseAttributes->status) && $responseAttributes->status == self::RESPONSE_STATUS_FAILED){
            throw new \Exception($response->error);
        } elseif(!isset($responseAttributes->status)) {
            throw new \Exception('Invalid response');
        }
    }

}
