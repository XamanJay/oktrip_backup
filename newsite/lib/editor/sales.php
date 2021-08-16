<?php
 
/*
 * Example PHP implementation used for the index.html example
 */
 
// DataTables PHP library
include("DataTables.php");
 
// Alias Editor classes so they are easy to use
use
    DataTables\Editor,
    DataTables\Editor\Field,
    DataTables\Editor\Format,
    DataTables\Editor\Mjoin,
    DataTables\Editor\Options,
    DataTables\Editor\Upload,
    DataTables\Editor\Validate;
 
// Build our Editor instance and process the data coming from _POST
Editor::inst( $db, 'sales','Id' ) 
    ->fields(
        Field::inst( 'sales.Id' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'sales.Key_' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'sales.Date' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'sales.Customer_id' )
            ->options(Options::inst()
                ->table('customers')
                ->value('Id')
                ->label( array('Name', 'LastName'))
            ),
        Field::inst( 'customers.Name'),
        Field::inst( 'customers.LastName'),
        Field::inst( 'customers.Email'),
        Field::inst( 'customers.Country'),
        Field::inst( 'customers.City'),

        Field::inst( 'services.Name'),
        Field::inst( 'services.TypeService'),
        Field::inst( 'services.DateFrom'),
        Field::inst( 'services.DateTo'),
        Field::inst( 'services.Comments'),
        Field::inst( 'payments.Status'),
        Field::inst( 'payments.Total'),
        Field::inst( 'payments.Subtotal')

    )
    ->leftJoin( 'customers', 'customers.Id', '=', 'sales.Customer_id' )
    ->leftJoin( 'services', 'services.Id', '=', 'sales.Service_id' )
    ->leftJoin( 'payments', 'payments.Id', '=', 'sales.Payment_id' )
    ->where( 'services.DateFrom',date("Y-m-d H:i:s", mktime(0, 0, 0, 1, 1, 2017)), ">=")
    ->where( 'services.Offline',0)
    ->where( 'sales.isDeleted', 0)
    ->where( 'services.TypeService',"hotel")
    ->process( $_POST )
    ->json();


/*    // Build our Editor instance and process the data coming from _POST
Editor::inst( $db, 'users','Id' )
->fields(
    Field::inst( 'users.Email' )->validator( 'Validate::notEmpty' ),
    Field::inst( 'personas.Nombre' ),
    Field::inst( 'personas.Apellido_paterno' ),
    Field::inst( 'clientes.NumeroSocio' ),
    Field::inst( 'clientes.Puntos' ))
->leftJoin( 'personas', 'personas.Id', '=', 'users.Id' )
->leftJoin( 'clientes', 'clientes.Id', '=', 'users.Id' )
->process( $_POST )
->json();*/