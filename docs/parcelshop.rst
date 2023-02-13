.. _top:
.. title:: Parcel shops

`Back to index <index.rst>`_

============
Parcel shops
============

.. contents::
    :local:


Get Parcel shops by country
```````````````````````````

.. code-block:: php
    
    $countryCode = 'DE';
    $result = $client->parcelshop->getByCountry($countryCode);


Get Parcel shop
```````````````

.. code-block:: php
    
    $parcelShopId = 'GLS_DE-2761234567';
    $result = $client->parcelshop->get($parcelShopId);


Get Parcel shops in area
````````````````````````

.. code-block:: php
    
    $result = $client->parcelshop->getInArea([
        'From' => [
            'Latitude' => '48.57035',
            'Longitude' => '12.62896'
        ],
        'To' => [
            'Latitude' => '48.79115',
            'Longitude' => '9.00543'
        ],
    ]);


Find nearest Parcel shop for address
````````````````````````````````````

.. code-block:: php
    
    $result = $client->parcelshop->findNearestForAddress([
        'Street' => 'Marktplatz',
        'StreetNumber' => '52',
        'CountryCode' => 'DE',
        'ZIPCode' => '94419',
        'City' => 'Reisbach'
    ]);


Get Parcel shop in distance
```````````````````````````

.. code-block:: php
    
    $result = $client->parcelshop->getInDistance([
        'Latitude' => '48.784177',
        'Longitude' => '6.885992',
        'Distance' => '20'
    ]);


`Back to top <#top>`_