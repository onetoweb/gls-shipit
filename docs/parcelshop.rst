.. _top:
.. title:: Parcel shops

`Back to index <index.rst>`_

=======
Parcels
=======

.. contents::
    :local:


Get Parcel shops by Country
```````````````````````````

.. code-block:: php
    
    $countryCode = 'BE';
    $result = $client->parcelshop->getByCountry($countryCode);


Parcels Details
```````````````

.. code-block:: php
    
    $parcelShopId = 'GLS_DE-2761234567';
    $result = $client->parcelshop->get($parcelShopId);


`Back to top <#top>`_