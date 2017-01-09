<?php

namespace RetsBundle\Adapter;

use RetsBundle\Adapter\Mapper AS MAPPER;

/**
 * Returns the MlsMapper that corresponds to the selected market
 */
class mlsMapperSelector
{


    /**
     * selectMlsMapper
     * Select Sell Mapper for this market
     * @param  string marketState
     * @param int marketId
     */
    public static function selectMlsMapper($marketState, $marketId)
    {
        // TODO complete switch with all markets
    	switch ($marketState) {
            case 'Houston':
                return new MAPPER\houstonMlsMapper($marketId);
                break;
            case 'San Antonio':
                return new MAPPER\sanAntonioMlsMapper($marketId);
                break;
    		case 'Colorado':
    			return new MAPPER\coloradoMlsMapper($marketId);
    			break;
            case 'Atlanta':
                return new MAPPER\atlantaMlsMapper($marketId);
                break;
            case 'Austin':
                return new MAPPER\austinMlsMapper($marketId);
                break;
            case 'Central Florida':
                return new MAPPER\centralFloridaMlsMapper($marketId);
                break;
            case 'DFW':
                return new MAPPER\dfwMlsMapper($marketId);
                break;
            case 'Los Angeles':
                return new MAPPER\losAngelesMlsMapper($marketId);
                break;
            case 'Philadelphia':
                return new MAPPER\philadelphiaMlsMapper($marketId);
                break;
    		
    		default:
                // should we stop execution if no available market?
    			return new MAPPER\coloradoMlsMapper($marketId);
    			break;
    	}
    }

    /**
     * selectMlsLeasedMapper
     * Select Leased Mapper for this market
     * @param  string marketState
     * @param int marketId
     */
    public static function selectMlsLeasedMapper($marketState, $marketId)
    {
        // TODO complete switch with all markets
        switch ($marketState) {
            case 'Colorado':
                return new MAPPER\coloradoMlsLeasedMapper($marketId);
                break;
            default:
                // should we stop execution if no available market?
                return new MAPPER\coloradoMlsLeasedMapper($marketId);
                break;
        }
    }
}
