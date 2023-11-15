.. _top:
.. title:: Shipments

`Back to index <index.rst>`_

=========
Shipments
=========

.. contents::
    :local:


Create Shipment
```````````````

.. code-block:: php
    
    // create shipment
    $result = $client->shipment->create([
        'Shipment' => [
            'ShipmentReference' => [
                'Ref-Unit-1234'
            ],
            'Product' => 'PARCEL',
            'Consignee' => [
                'ConsigneeID' => '1234567890',
                'Address' => [
                    'Name1' => 'Tim Test',
                    'Name2' => '',
                    'Name3' => '',
                    'CountryCode' => 'DE',
                    'ZIPCode' => '65760',
                    'City' => 'Testingen',
                    'Street' => 'Testallee',
                    'eMail' => 'tim.test@gls.de',
                    'ContactPerson' => 'Laura Test',
                    'MobilePhoneNumber' => '004912345678910',
                    'FixedLinePhonenumber' => '004912345678910'
                ]
            ],
            'Shipper' => [
                'ContactID' => '2761234567',
            ],
            'ShipmentUnit' => [
                [
                    'Weight' => 5
                ]
            ]
        ],
        'PrintingOptions' => [
            'ReturnLabels' => [
                'TemplateSet' => 'NONE',
                'LabelFormat' => 'PDF'
            ]
        ]
    ]);
    
    // write label to file
    $filename = '/path/to/file.pdf';
    $data = $result['CreatedShipment']['PrintData'][0]['Data'];
    
    $result = \Onetoweb\Gls\Shipit\Utils::writeLabel($filename, $data);


Create Multi Collie Shipment
````````````````````````````

.. code-block:: php
    
    // create shipment
    $result = $client->shipment->create([
        'Shipment' => [
            'ShipmentReference' => [
                'Ref-Unit-1234'
            ],
            'Product' => 'PARCEL',
            'Consignee' => [
                'ConsigneeID' => '1234567890',
                'Address' => [
                    'Name1' => 'Tim Test',
                    'Name2' => '',
                    'Name3' => '',
                    'CountryCode' => 'DE',
                    'ZIPCode' => '65760',
                    'City' => 'Testingen',
                    'Street' => 'Testallee',
                    'eMail' => 'tim.test@gls.de',
                    'ContactPerson' => 'Laura Test',
                    'MobilePhoneNumber' => '004912345678910',
                    'FixedLinePhonenumber' => '004912345678910'
                ]
            ],
            'Shipper' => [
                'ContactID' => '2761234567',
            ],
            'ShipmentUnit' => [
                [
                    'Weight' => 5
                ], [
                    'Weight' => 6
                ]
            ]
        ],
        'PrintingOptions' => [
            'ReturnLabels' => [
                'TemplateSet' => 'NONE',
                'LabelFormat' => 'PDF'
            ]
        ]
    ]);
    
    // write labels to file
    $i = 1;
    foreach ($result['CreatedShipment']['PrintData'] as $printData) {
        
        $filename = "/path/to/file_$i.pdf";
        
        $result = \Onetoweb\Gls\Shipit\Utils::writeLabel($filename, $printData['Data']);
        
        $i++;
    }


Cancel Shipment
```````````````

.. code-block:: php
    
    $trackId = 'YZ8YPH2Q';
    $result = $client->shipment->cancel($trackId);    


Get allowed services
````````````````````

.. code-block:: php
    
    $result = $client->shipment->getAllowedServices([
        'Source' => [
            'CountryCode' => 'DE',
            'ZIPCode' => '38106'
        ],
        'Destination' => [
            'CountryCode' => 'DE',
            'ZIPCode' => '65779'
        ]
    ]);


Get end of day report
`````````````````````

.. code-block:: php
    
    $date = new \DateTime();
    $result = $client->shipment->getEndOfDayReport($date);


Update parcel weight
````````````````````

.. code-block:: php
    
    $trackId = 'YZ8YPH2Q';
    $weight = 3.14;
    $result = $client->shipment->updateParcelWeight($trackId, $weight);


`Back to top <#top>`_
