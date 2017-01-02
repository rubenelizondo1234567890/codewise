<?php

namespace RetsBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Psr\Log\LoggerInterface;

use RetsBundle\Adapter\mlsMapperSelector;

/**
 * RetsBundleMlsFetcherCommand
 * Executes Sell Properties fetching
 */
class RetsBundleMlsFetcherCommand extends ContainerAwareCommand
{
    /** @var retsService */
    private $retsService;

    /** @var logger */
    private $logger;

    protected function configure()
    {
        $this
            ->setName('RetsBundle:mlsFetcher')
            ->setDescription('Fetches MLS listings from RETS Servers')
            ->setHelp("Currently only works on Colorado")
            ->addArgument('marketState', InputArgument::REQUIRED, 'RETS Server market State')
        ;
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {      
        $this->retsService = $this->getContainer()->get('rets.service.provider');

        $this->logger = $this->getContainer()->get('logger');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $marketState = $input->getArgument('marketState');

        // Hack to deal with two word markets?
        if ($marketState == 'SanAntonio') {$marketState = 'San Antonio';}
        if ($marketState == 'LosAngeles') {$marketState = 'Los Angeles';}
        if ($marketState == 'CentralFlorida') {$marketState = 'Central Florida';}

        // Check this command is not already running for this market
        $execute = $this->retsService->checkMlsPropertiesCursorActive($marketState);
        
        if($execute){

        //TODO: Currently we only have search capability in Colorado for this bundle
        $marketId = $this->retsService->getMarketId($marketState);

            if ($marketId){

                //  Moving try to the beginning so to catch all exceptions
                try {
                
                // Start a new Session        
                $init = $this->retsService->startSession($marketState);

                // Login to the Rets Server
                $connect = $this->retsService->Retslogin();

                // Get Start timestamp for next search from MlsPropertiesCursor
                $mlsPropertiesCursor = $this->retsService->getMlsPropertiesCursor($marketState);

                // Set cursor to inactive to avoid other process try to run it
                $this->retsService->setMlsPropertiesCursorInactive($mlsPropertiesCursor);

                // Get search params resources
                $resources = $this->retsService->getRetsResources($marketState, 'SELL');

                // Get query string
                $currentDateTime = new \dateTime;
                $query = $this->retsService->getQuery($mlsPropertiesCursor, $currentDateTime, $resources->queryDateName);

                $mapperObjCollection = [];
            
                    // limiting to only 100 properties per batch
                    // TODO: Investigate how many properties to fetch per batch so not to overload the process
                    // updating to 10 properties for testing in platform.sh
                    $mlsProperties = $this->retsService->RetsSearch($resources->property, $resources->class, $query, 10);

                    if (count($mlsProperties)>0) { 

                        foreach ($mlsProperties as $key => $value) {

                            $mapperObj = mlsMapperSelector::selectMlsMapper($marketState, $marketId);

                            $mapperObj->mapToMlsProperties($value);
                    
                            array_push($mapperObjCollection, $mapperObj);

                        }

                        //Persist to DB
                        $this->retsService->persistMlsProperties($mapperObjCollection, $marketState);

                        //Update cursor after successful transaction and set to active and new datetimestamp
                        $this->retsService->updateCursor($mlsPropertiesCursor, $currentDateTime);

                    } else {
                        $this->logger->error('Empty search results -- verify query');
                        //Update cursor with  original timestamp and set to active
                        $this->retsService->setMlsPropertiesCursorToOriginal($mlsPropertiesCursor);
                    }

                } catch (\Exception $e) {
                    $this->logger->error($e->getMessage());
                    //Update cursor with  original timestamp and set to active
                    $this->retsService->setMlsPropertiesCursorToOriginal($mlsPropertiesCursor);
                }

                $this->logger->info('Executed Search on Market: -- '.$marketState.' -- Properties found:'.count($mlsProperties).' -- with Query:'.$query);

            } else {
            
                $this->logger->info('No Market Id for this Market -- State');
            }
        } else {
            $this->logger->info('Cannot execute this command at this time -- other process is still running it');
        }
    }

}
