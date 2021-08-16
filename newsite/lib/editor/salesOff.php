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
        Field::inst( 'sales.Customer_id' )
            ->options(Options::inst()
                ->table('customers')
                ->value('Id')
                ->label( array('Name'))
            ),
        Field::inst( 'customers.Name'),

        Field::inst( 'sales.Service_id' )
            ->options(Options::inst()
                ->table('services')
                ->value('Id')
                ->label( array('Name', 'TypeService','NameProvider','DateFrom','DateTo','NoPeople'))
            ),
        Field::inst( 'services.Name'),
        Field::inst( 'services.NameProvider'),
        Field::inst( 'services.TypeService'),
        Field::inst( 'services.DateFrom'),
        Field::inst( 'services.DateTo'),
        Field::inst( 'services.NoPeople'),

        Field::inst( 'sales.Payment_id' )
            ->options(Options::inst()
                ->table('payments')
                ->value('Id')
                ->label( array('Reference','Total','Subtotal','AuthorizationNo'))
            ),
        Field::inst( 'payments.Reference'),
        Field::inst( 'payments.Total'),
        Field::inst( 'payments.Subtotal'),
        Field::inst( 'payments.AuthorizationNo')
    )
    ->leftJoin( 'customers', 'customers.Id', '=', 'sales.Customer_id' )
    ->leftJoin( 'services', 'services.Id', '=', 'sales.Service_id' )
    ->leftJoin( 'payments', 'payments.Id', '=', 'sales.Payment_id' )
    ->where( 'services.Offline',1)
    ->where( 'sales.isDeleted', 0)
    ->process( $_POST )
    ->json();
