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
Editor::inst( $db, 'hotels_city','Id' )
    ->fields(
        Field::inst( 'hotels_city.Id' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'hotels_city.IdHotel' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'hotels_city.Name' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'hotels_city.ZoneName' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'hotels_city.Category' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'hotels_city.Address' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'hotels_city.City_id' )
            ->options( Options::inst()
                ->table( 'cities' )
                ->value( 'Id' )
                ->label( array('Name','Country') )
            ),
        Field::inst( 'cities.IdCity'),
        Field::inst( 'cities.Name'),
        Field::inst( 'cities.Country')
    )
    ->leftJoin( 'cities', 'cities.Id', '=', 'hotels_city.City_id' )
    ->where( 'hotels_city.isDeleted', 0)
    ->process( $_POST )
    ->json();