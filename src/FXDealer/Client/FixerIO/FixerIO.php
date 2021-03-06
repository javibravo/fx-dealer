<?php
/**
 * Created by PhpStorm.
 * User: jbravo
 * Date: 03/10/15
 * Time: 16:11
 */

namespace FXDealer\Client\FixerIO;

use FXDealer\Client\Client;
use FXDealer\Client\Rating;
use GuzzleHttp\Exception\ClientException;
use DateTime;

class FixerIO extends Client implements Rating {

    public function __construct(array $options = array()) {
        $this->endpointUrl = 'api.fixer.io';
        parent::__construct($options);
    }

    public function getLatest($base = 'EUR') {
        try {
            $response = $this->webClient->request('GET', $this->getUrl('latest', ['base' => $base]));
            return json_decode($response->getBody(), true);
        } catch (ClientException $ex) {
            throw $ex;
        }
    }

    public function getHistorical(DateTime $day, $base = 'EUR') {
        try {
            $response = $this->webClient->request('GET', $this->getUrl($day->format(self::DAY_FORMAT), ['base' => $base]));
            return json_decode($response->getBody(), true);
        } catch (ClientException $ex) {
            throw $ex;
        }
    }

}