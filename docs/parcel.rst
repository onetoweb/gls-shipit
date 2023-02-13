.. _top:
.. title:: Parcels

`Back to index <index.rst>`_

=======
Parcels
=======

.. contents::
    :local:


Track Parcels
`````````````

.. code-block:: php
    
    // track parcel from the last 7 days
    $dateFrom = (new \DateTime())->modify('-7 days');
    $dateTo = new \DateTime();
    
    $result = $client->parcel->track($dateFrom, $dateTo);


Parcels Details
```````````````

.. code-block:: php
    
    $trackId = 'P3L11002';
    $result = $client->parcel->detail($trackId);


`Back to top <#top>`_