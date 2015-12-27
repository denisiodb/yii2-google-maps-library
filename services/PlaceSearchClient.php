<?php
/**
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace dosamigos\google\maps\services;

use dosamigos\google\maps\ClientAbstract;
use yii\helpers\ArrayHelper;

/**
 * PlaceDetailsClient
 *
 * Utility class to call Google Places API to find places by a query
 * For further information please visit https://developers.google.com/places/web-service/search#TextSearchRequests
 *
 * @author Denis Alyanov
 * @package dosamigos\google\maps
 */
class PlaceSearchClient extends ClientAbstract
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
                'language' => null,
                'minprice' => null,
                'maxprice' => null,
                'opennow' => null,
                'types' => null,
                'pagetoken' => null,
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
        return 'https://maps.googleapis.com/maps/api/place/textsearch/' . $this->format;
    }

    /**
     * Makes a request for a list of places fitting the query. Please, review the documentation on
     * https://developers.google.com/places/web-service/search#TextSearchRequests
     * for further information about the expected results.
     *
     * @param string $query Text query
     * @param array $params parameters for the request. These override [GeocodingRequest::params].
     *
     * @return mixed|null
     * @throws \yii\base\InvalidConfigException
     */
    public function findPlaces($query, $params = [])
    {
        $params['query'] = $query;

        $this->params = ArrayHelper::merge($this->params, $params);

        return parent::request();
    }
}
