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
Editor::inst( $db, 'cities','Id' )
    ->fields(
        Field::inst( 'Id' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'IdCity' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'Name' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'IdCountry' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'Country' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'Path' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'Longitude' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'Latitude' )->validator( 'Validate::notEmpty' ))
    ->where( 'isDeleted', 0)
    ->process( $_POST )
    ->json();