<?php


namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use App\Entity\BlogPost;
use App\Entity\Department;
use App\Entity\Product;

class EasyAdminSubscriber implements EventSubscriberInterface
{

    public function __construct()
    {
        
    }


    public static function getSubscribedEvents()
    {
        return array(
            'easy_admin.pre_remove' => array('deleteAssociations'),
        );
    }


    public function deleteAssociations(GenericEvent $event) {
        
        $entity = $event->getSubject();

        if (!($entity instanceof Department) and !($entity instanceof Product)) {
            return;
        }
        
        $entity->removeAssociations();
        $event['entity'] = $entity;

    }
}