<?php

namespace RetsBundle\Adapter\Helper;

use RetsBundle\Entity\MlsProperties;
use RetsBundle\Entity\MlsPropertyPhotos;

use Doctrine\ORM\EntityManager;
use S3;

/**
 * mlsImageHelper
 * Helps on fetching and storing images to given route
 */
class mlsImageHelper
{

	/**
     * storeImagesLocal
     * stores all images for each Mls Num in given route in local storage
     * @param object $imagesObj
     * @param string $storageRoute
     */
	public static function storeImagesLocal($imagesObj, $storageRoute)
	{
		foreach ($imagesObj as $img) {

			// TODO: verify if images are in different formats than in jpg
            if ($img->getContentType() == 'image/jpeg') {

                $imgName = $storageRoute.$img->getContentId().'_'.$img->getObjectId().'.jpg';

        		// Create image
        		$im = imagecreatefromstring($img->getContent());

                // TODO: Should we save only new images?                 
                imagejpeg($im, $imgName, 95);

            }
            
        }
	}

    /**
     * storeImagesS3
     * stores all images for each Mls Num in given route in Amazon S3 given Bucket
     * @param object $imagesObj
     * @param string $localstorageRoute
     * @param string $remotestorageRoute
     * @param string $awsbucketName
     */
    public static function storeImagesS3($imagesObj, $localStorageRoute, $remoteStorageRoute, $awsbucketName)
    {
        foreach ($imagesObj as $img) {

            // TODO: verify if images are in different formats than in jpg
            if ($img->getContentType() == 'image/jpeg') {

                $imgName = $localStorageRoute.$img->getContentId().'_'.$img->getObjectId().'.jpg';

                $uploadName = $remoteStorageRoute.$img->getContentId().'_'.$img->getObjectId().'.jpg';

                S3::putObject(S3::inputFile($imgName, false), $awsbucketName, $uploadName, S3::ACL_PUBLIC_READ);

            }
            
        }
    }


    /**
     * persistMlsPropertyPhotos
     * Insert/Update S3 img details in DB
     * @param object $imagesObj
     * @param string $localstorageRoute
     * @param string $remotestorageRoute
     * @param string $awsbucketName
     * @param string $em
     * @param string $mlsPropertyId
     */
    public static function persistMlsPropertyPhotos($imagesObj, $localStorageRoute, $remoteStorageRoute, $awsbucketName, EntityManager $em, $mlsPropertyId)
    {
        foreach ($imagesObj as $img) {

            // TODO: verify if images are in different formats than in jpg
            if ($img->getContentType() == 'image/jpeg') {

                // Insert or Update based on MlsNum  is on db or not
                $id = $mlsPropertyId;
                $rank = $img->getObjectId();

                $mlsPropertyPhotos = $em->getRepository('RetsBundle:MlsPropertyPhotos')->findOneBy(['mlsPropertyId' => $id, 'rank' => $rank]);

                if($mlsPropertyPhotos) {

                    // Update new Mls property photos
                    $mlsPropertyPhotos->setDateUpdated(new \dateTime);

                    $em->persist($mlsPropertyPhotos);
                    $em->flush($mlsPropertyPhotos);

                } else {

                    // Insert new Mls property photos
                    $mlsPropertyPhotos = new MlsPropertyPhotos();

                    $mlsPropertyPhotos->setMlsPropertyId($id);

                    $name = $remoteStorageRoute.$img->getContentId().'_'.$img->getObjectId().'.jpg';

                    $mlsPropertyPhotos->setUrl('https://'.$awsbucketName.'.s3.amazonaws.com/'.$name);
                    $mlsPropertyPhotos->setName($name);

                    $mlsPropertyPhotos->setRank($rank);
                    $mlsPropertyPhotos->setAs3BucketName($awsbucketName);
                    $mlsPropertyPhotos->setDateUpdated(new \dateTime);
                    $mlsPropertyPhotos->setDateCreated(new \dateTime);

                    $em->persist($mlsPropertyPhotos);
                    $em->flush($mlsPropertyPhotos);

                }

            }
            
        }
    }    

    /**
     * removeImagesLocal
     * removes all images for each Mls Num in given route in local storage
     * @param object $imagesObj
     * @param string $storageRoute
     */
    public static function removeImagesLocal($imagesObj, $storageRoute)
    {
        foreach ($imagesObj as $img) {

            // TODO: verify if images are in different formats than in jpg
            if ($img->getContentType() == 'image/jpeg') {

                $imgName = $storageRoute.$img->getContentId().'_'.$img->getObjectId().'.jpg';

                // Remove if local img file exists
                if(file_exists($imgName)) {
                    unlink($imgName);
                } else {
                    // log error
                    $logger->info('Non-Existent Image:'.$imgName);
                }
            }
            
        }
    }
}