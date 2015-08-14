<?php


namespace WilsonCreative\NordicGateway\Http\Controllers;

use Guzzle\Http\Client;
use Illuminate\Http\Request;
use WilsonCreative\NordicGateway\Http\Controllers\Controller as BaseController;

class MainController extends BaseController
{

    public function store(Request $request)
    {
        // validate indata
        /*
         * - ClientId
         * - ShipToCompany (semi required)
         * - ShipToFirstname (semi required)
         * - ShipToLastname (semi required)
         * - ShipToAddress (required)
         * - ShipToAddress2
         * - ShipToPostalCode (required)
         * - ShipToCity (required)
         * - ShipToCountry [Lista på svenska]
         * - ShipToEmail
         * - ShipToPhone
         * - ShipToFax
         * - Text1 [Eget fält]
         * - QuantityARTIKELNR1 [ARTIKELNR1 byts ut mot artikelnr?] numeric
         * - ItemIdentifier [Skicka artikelnr som värde]
         */

        // paketera data


        // posta till http://linabews.lxir.se/order13.asp
        $client = new Client(getenv('NORDICGATEWAY_ENDPOINT'));
        $request = $client->post('order13.asp', null, $data)->send();

        return $request->getStatusCode();
    }

}