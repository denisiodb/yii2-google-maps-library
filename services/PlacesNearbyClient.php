<?php
/**
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace dosamigos\google\maps\services;

use dosamigos\google\maps\ClientAbstract;
use dosamigos\google\maps\LatLng;
use yii\helpers\ArrayHelper;

/**
 * PlaceDetailsClient
 *
 * Utility class to call Google Places API to get place details.
 * For further information please visit https://developers.google.com/places/web-service/details
 *
 * @author Denis Alyanov
 * @package dosamigos\google\maps
 */
class PlacesNearbyClient extends ClientAbstract
{
    /**
     * @inheritdoc
     * @param array $config
     */
    public function __construct($config = [])
    {

        $this->params = ArrayHelper::merge(
            [
                'location' => null,
                'radius' => null,
                'keyword' => null,
                'minprice' => null,
                'maxprice' => null,
                'name' => null,
                'opennow' => null,
                'rankby' => null,
                'types' => null,
                'pagetoken' => null,
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
        return 'https://maps.googleapis.com/maps/api/place/nearbysearch/' . $this->format;
    }

    /**
     * Makes a request for places nearby. Please, review the documentation on
     * https://developers.google.com/places/web-service/search#PlaceSearchResponses
     * for further information about the expected results.
     *
     * @param string $placeId Place ID
     * @param array $params parameters for the request. These override [GeocodingRequest::params].
     *
     * @return mixed|null
     * @throws \yii\base\InvalidConfigException
     */
    public function findPlaces(LatLng $location, $radius, $params = [])
    {
        $params['location'] = $location;
        $params['radius'] = $radius;

        $this->params = ArrayHelper::merge($this->params, $params);

        return parent::request();
    }
}
