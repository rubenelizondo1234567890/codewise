<?php

namespace RetsBundle\Adapter;

/**
 * mlsMapperInterface
 * Defines methods to be used by mappers
 */
interface mlsMapperInterface
{
	function mapToMlsProperties($mlsFetchedRow);

    function setMappedProperties($property, $value);

}
