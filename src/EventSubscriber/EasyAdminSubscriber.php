<?php


namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use App\Entity\Department;
use App\Entity\Product;
use App\Entity\Report;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    public static function getSubscribedEvents()
    {
        return array(
            'easy_admin.pre_remove' => array('deleteAssociations'),
            'easy_admin.post_show' => array('makeReportSeen')
        );
    }


    public function deleteAssociations(GenericEvent $event)
    {

        $entity = $event->getSubject();

        if ($entity instanceof Department) {

            $members = $entity->getEmployees();

            foreach ($members as $member) {

                $member->setRoles(['ROLE_USER']);
            }

            $event['entity'] = $entity;
        }

        if (!($entity instanceof Department) and !($entity instanceof Product)) {
            return;
        }

        $entity->removeAssociations();
        $event['entity'] = $entity;
    }



    public function makeReportSeen(GenericEvent $event)

    {
        $entity = $event-> getSubject();

        if ($entity instanceof Report) {

            $entity->setSeen(true);

            $this->em->persist($entity);
            $this->em->flush();

            $event['entity'] = $entity;
        }

    }
}
