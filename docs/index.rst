.. title:: Index

===========
Basic Usage
===========

Setup client

.. code-block:: php
    
    require 'vendor/autoload.php';
    
    use Onetoweb\Gls\Shipit\Client;
    
    // params
    $user = 'user';
    $password = 'password';
    $baseHref = 'base_href';
    
    // setup client
    $client = new Client($user, $password, $baseHref);
    
    // add requester (optional)
    $client->setRequester('Requester');


========
Examples
========

* `Shipments <shipment.rst>`_
* `Parcels <parcel.rst>`_
* `Parcel shops <parcelshop.rst>`_
* `Timeframe <timeframe.rst>`_