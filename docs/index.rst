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
    
    // setup client
    $client = new Client($user, $password);
    
    // add requester (optional)
    $client->setRequester('Requester');


========
Examples
========

* `Shipments <shipment.rst>`_
* `Parcels <parcel.rst>`_
