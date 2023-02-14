.. _top:
.. title:: Timeframe

`Back to index <index.rst>`_

=========
Timeframe
=========

.. contents::
    :local:


Get estimated delivery days
```````````````````````````

.. code-block:: php
    
    $result = $client->timeframe->deliverydays([
        'Source' => [
            'Address' => [
                'Street' => 'Platz der Republik',
                'StreetNumber' => '1',
                'CountryCode' => 'DE',
                'ZIPCode' => '10557',
                'City' => 'Berlin'
            ]
        ],
        'Destination' => [
            'Address' => [
                'Street' => 'Platz der Vereinten Nationen',
                'StreetNumber' => '2',
                'CountryCode' => 'DE',
                'ZIPCode' => '53113',
                'City' => 'Bonn'
            ]
        ]
    ]);


`Back to top <#top>`_