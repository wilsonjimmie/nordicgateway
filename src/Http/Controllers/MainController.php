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
        $this->validate($request, [
            'ClientId'          => 'required',
            'ShipToCompany'     => 'required_without:ShipToFirstname,ShipToLastname',
            'ShipToFirstname'   => 'required_without:ShipToCompany',
            'ShipToLastname'    => 'required_without:ShipToCompany',
            'ShipToAddress'     => 'required',
            'ShipToAddress2'    => '',
            'ShipToPostalCode'  => 'required',
            'ShipToCity'        => 'required',
            'ShipToCountry'     => 'required',
            'ShipToEmail'       => '',
            'ShipToPhone'       => '',
            'ShipToFax'         => '',
            'Text1'             => '', // Eget fält
            'Quantity[*]'       => '',
            'ItemIdentifier'    => ''
        ]);


        // posta till http://linabews.lxir.se/order13.asp
        $client = new Client(getenv('NORDICGATEWAY_ENDPOINT'));
        $request = $client->post('order13.asp', null, $request->all())->send();

        return $request->getStatusCode();

    }

}