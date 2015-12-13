<?php
/**
 * @copyright Copyright (c) 2014 2amigOS! Consulting Group LLC
 * @link http://2amigos.us
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace dosamigos\google\maps\services;


use dosamigos\google\maps\ClientAbstract;
use dosamigos\google\maps\LatLng;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * DistancesClient
 *
 * Utility class to call Google's Distance Matrix API
 * to get travel times and distances between points.
 * For further information please visit
 * https://developers.google.com/maps/documentation/distance-matrix/intro#DistanceMatrixResponses
 *
 * @author Denis Alyanov
 * @package dosamigos\google\maps
 */
class DistancesClient extends ClientAbstract
{
    /**
     * @inheritdoc
     * @param array $config
     */
    public function __construct($config = [])
    {

        $this->params = ArrayHelper::merge(
            [
                'origins' => null,
                'destinations' => null,
                'mode' => null,
                'avoid' => null,
                'units' => null,
                'arrival_time' => null,
                'departure_time' => null,
                'traffic_model' => null,
                'transit_mode' => null,
                'transit_routing_preference' => null,
                'language' => null,
            ],
            $this->params
        );

        parent::__construct($config);
    }

    /**
     * Returns the api url
     * @return string
     */
    public function getUrl()
    {
        return 'https://maps.googleapis.com/maps/api/distancematrix/' . $this->format;
    }

    /**
     * Makes a reverse geocoding by coordinates
     *
     * @param LatLng $coord
     * @param array $params parameters for the request. These override [GeocodingRequest::params].
     * @return mixed|null
     */
    
    
    /**
     * Calculates distances and travel times between origins and destinations
     * 
     * @param array $origins Addresses or coordinates
     * @param array $destinations Addresses or coordinates
     * @param array $params
     * @return mixed|null
     */
    public function calculate(array $origins, array $destinations, $params = [])
    {
        $params['origins'] = implode('|', $origins);
        $params['destinations'] = implode('|', $destinations);

        $this->params = ArrayHelper::merge($this->params, $params);

        return parent::request();
    }
}
