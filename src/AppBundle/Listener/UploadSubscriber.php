<?php

namespace AppBundle\Listener;


use AppBundle\Annotation\UploadAnnotationReader;
use AppBundle\Handler\UploadHandler;
use Doctrine\Common\EventArgs;
use Doctrine\Common\EventSubscriber;


class UploadSubscriber implements EventSubscriber
{
    /**
     * @var UploadAnnotationReader
     */
    private $reader;

    /**
     * @var UploadHandler
     */
    private $handler;

    public function __construct(UploadAnnotationReader $reader, UploadHandler $handler)
    {
        $this->reader = $reader;
        $this->handler = $handler;
    }

    /**
     * @return array
     */
    public function getSubscribedEvents()
    {
        return [
            'prePersist',
            'preUpdate',
            'postLoad',
            'postRemove'
        ];
    }

    /**
     * @param EventArgs $event
     */
    public function prePersist(EventArgs $event)
    {
        $this->preEvent($event);
    }

    /**
     * @param EventArgs $event
     */
    public function preUpdate(EventArgs $event)
    {
        $this->preEvent($event);
    }

    /**
     * @param EventArgs $event
     */
    public function postLoad(EventArgs $event)
    {
        $entity = $event->getEntity();
        foreach ($this->reader->getUploadableFields($entity) as $property => $annotation){
            $this->handler->setFileFromFilename($entity, $property, $annotation);
        }
    }

    /**
     * @param EventArgs $event
     */
    public function postRemove(EventArgs $event)
    {
        $entity = $event->getEntity();
        foreach ($this->reader->getUploadableFields($entity) as $property => $annotation){
            $this->handler->removeFile($entity, $property);
        }
    }

    /**
     * @param EventArgs $event
     */
    private function preEvent(EventArgs $event)
    {
        $entity = $event->getEntity();
        foreach ($this->reader->getUploadableFields($entity) as $property => $annotation){
            $this->handler->uploadFile($entity, $property, $annotation);
        }
    }
}