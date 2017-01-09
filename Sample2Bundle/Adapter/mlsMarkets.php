<?php

namespace RetsBundle\Adapter;


/**
 * mlsMarkets
 * Wrapper for market specific constant values
 */
final class mlsMarkets
{
	// Houston
	const  HOUSTON_PROPERTY = 'Property';
    const  HOUSTON_CLASS = 'Listing';
    const  HOUSTON_QUERY_DATE = 'MatrixModifiedDT';

    // San Antonio
    const  SAN_ANTONIO_PROPERTY = 'Property';
    const  SAN_ANTONIO_CLASS = 'RE';
    const  SAN_ANTONIO_QUERY_DATE = 'L_UpdateDate';

    // Colorado for Sell
    const  COLORADO_PROPERTY = 'Property';
    const  COLORADO_CLASS = 'RESI';
    const  COLORADO_QUERY_DATE = 'MatrixModifiedDT';

    // Colorado for Lease
    // TODO: Wait for contract extension for fetching leased properties
    const  COLORADO_PROPERTY_LEASED = 'Property';
    const  COLORADO_CLASS_LEASED = 'LEASED'; // Currently not working
    const  COLORADO_QUERY_DATE_LEASED = 'MatrixModifiedDT';

    // Atlanta
    const  ATLANTA_PROPERTY = 'Property';
    const  ATLANTA_CLASS = 'Listing';
    const  ATLANTA_QUERY_DATE = 'MatrixModifiedDT';

    // Austin
    const  AUSTIN_PROPERTY = 'Property';
    const  AUSTIN_CLASS = 'RESI';
    const  AUSTIN_QUERY_DATE = 'MatrixModifiedDT';

    // Central Florida
    const  CENTRAL_FLORIDA_PROPERTY = 'Property';
    const  CENTRAL_FLORIDA_CLASS = 'Listing';
    const  CENTRAL_FLORIDA_QUERY_DATE = 'MatrixModifiedDT';

    // DFW
    const  DFW_PROPERTY = 'Property';
    const  DFW_CLASS = 'Listing';
    const  DFW_QUERY_DATE = 'MatrixModifiedDT';

    // Los Angeles
    const  LOS_ANGELES_PROPERTY = 'Property';
    const  LOS_ANGELES_CLASS = 'Residential';
    const  LOS_ANGELES_QUERY_DATE = 'ModificationTimestamp';

    // Philadelphia
    const  PHILADELPHIA_PROPERTY = 'Property';
    const  PHILADELPHIA_CLASS = 'RES';
    const  PHILADELPHIA_QUERY_DATE = 'ModificationTimestamp';

    /**
     * mlsMarketResources
     * @param $marketState
     * returns object resources for specific market
     */
    public static function mlsMarketResources($marketState, $type)
    {
    	$resources = new \stdClass;       
        switch ($marketState) {
                case 'Colorado':
                    // TODO: Perform this check for all other markets
                    if($type == 'LEASE') {
                        $resources->property = self::COLORADO_PROPERTY_LEASED;
                        $resources->class = self::COLORADO_CLASS_LEASED;
                        $resources->queryDateName = self::COLORADO_QUERY_DATE_LEASED;
                    } else {
                        $resources->property = self::COLORADO_PROPERTY;
                        $resources->class = self::COLORADO_CLASS;
                        $resources->queryDateName = self::COLORADO_QUERY_DATE;
                    }
                    break;
                case 'Houston':
                    $resources->property = self::HOUSTON_PROPERTY;
                    $resources->class = self::HOUSTON_CLASS;
                    $resources->queryDateName = self::HOUSTON_QUERY_DATE;
                    break;
                case 'San Antonio':
                    $resources->property = self::SAN_ANTONIO_PROPERTY;
                    $resources->class = self::SAN_ANTONIO_CLASS;
                    $resources->queryDateName = self::SAN_ANTONIO_QUERY_DATE;
                    break;
                case 'Atlanta':
                    $resources->property = self::ATLANTA_PROPERTY;
                    $resources->class = self::ATLANTA_CLASS;
                    $resources->queryDateName = self::ATLANTA_QUERY_DATE;
                    break;
                case 'Austin':
                    $resources->property = self::AUSTIN_PROPERTY;
                    $resources->class = self::AUSTIN_CLASS;
                    $resources->queryDateName = self::AUSTIN_QUERY_DATE;
                    break;
                case 'Central Florida':
                    $resources->property = self::CENTRAL_FLORIDA_PROPERTY;
                    $resources->class = self::CENTRAL_FLORIDA_CLASS;
                    $resources->queryDateName = self::CENTRAL_FLORIDA_QUERY_DATE;
                    break;
                case 'DFW':
                    $resources->property = self::DFW_PROPERTY;
                    $resources->class = self::DFW_CLASS;
                    $resources->queryDateName = self::DFW_QUERY_DATE;
                    break;
                case 'Los Angeles':
                    $resources->property = self::LOS_ANGELES_PROPERTY;
                    $resources->class = self::LOS_ANGELES_CLASS;
                    $resources->queryDateName = self::LOS_ANGELES_QUERY_DATE;
                    break;
                case 'Philadelphia':
                    $resources->property = self::PHILADELPHIA_PROPERTY;
                    $resources->class = self::PHILADELPHIA_CLASS;
                    $resources->queryDateName = self::PHILADELPHIA_QUERY_DATE;
                    break;
                default:
                    # code...
                    break;
            }
        return $resources;
    }

}