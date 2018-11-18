<?php

namespace App\Listener;


use App\Entity\Property;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class ImageCacheSubsriber implements  EventSubscriber {


    /**
     * @var CacheManager
     */
    private $cacheManager;
    /**
     * @var UploaderHelper
     */
    private $helper;

    public function __construct(CacheManager $cacheManager, UploaderHelper $helper)
    {

        $this->cacheManager = $cacheManager;
        $this->helper = $helper;
    }

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return string[]
     */
    public function getSubscribedEvents()
    {
        return [
            'preRemove',
            'preUpdate'
        ];
    }

    /**
     * clean cache liip uploader when delete entity
     * @param LifecycleEventArgs $args
     */
    public function preRemove(LifecycleEventArgs $args){
        $loEntity = $args->getEntity();
        if (!$loEntity instanceof  Property){
            return;
        }
        $this->cacheManager->remove($this->helper->asset($loEntity, 'imageFile'));
    }

    /**
     * clean cache of liip uploader when filename updated
     * @param PreUpdateEventArgs $args
     */
    public function preUpdate(PreUpdateEventArgs $args){
        $loEntity = $args->getEntity();
        if (!$loEntity instanceof  Property){
            return;
        }
        if ($loEntity->getImageFile() instanceof UploadedFile) {
            $this->cacheManager->remove($this->helper->asset($loEntity, 'imageFile'));
        }
    }
}
