<?php

namespace App\EventSubscriber;

use App\Repository\EventRepository;
use CalendarBundle\CalendarEvents;
use CalendarBundle\Entity\Event;
use CalendarBundle\Event\CalendarEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CalendarSubscriber implements EventSubscriberInterface
{


    public function __construct(EventRepository $repository, UrlGeneratorInterface $router)
    {
        $this->repository = $repository;
        $this->router = $router;
    }

    public static function getSubscribedEvents()
    {
        return [
            CalendarEvents::SET_DATA => 'onCalendarSetData',
        ];
    }

    public function onCalendarSetData(CalendarEvent $calendar)
    {
        $start = $calendar->getStart();
        $end = $calendar->getEnd();
        $filters = $calendar->getFilters();

        // Modify the query to fit to your entity and needs
        // Change event.beginAt by your start date property
        $events = $this->repository
            ->createQueryBuilder('event')
            ->where('event.beginAt BETWEEN :start and :end OR event.endAt BETWEEN :start and :end')
            ->setParameter('start', $start->format('Y-m-d H:i:s'))
            ->setParameter('end', $end->format('Y-m-d H:i:s'))
            ->getQuery()
            ->getResult()
        ;

        foreach ($events as $event) {
            // this create the events with your data (here event data) to fill calendar
            $Event = new Event(
                $event->getTitle(),
                $event->getBeginAt(),
                $event->getEndAt() // If the end date is null or not defined, a all day event is created.
            );

            /*
             * Add custom options to events
             *
             * For more information see: https://fullcalendar.io/docs/event-object
             * and: https://github.com/fullcalendar/fullcalendar/blob/master/src/core/options.ts
             */

            $Event->setOptions([
                'backgroundColor' =>  "#1592A5",
                'borderColor' => '#17A2B8',
            ]);
            $Event->addOption(
                'url',
                $this->router->generate('event_show', [
                    'id' => $event->getId(),
                ])
            );

            // finally, add the event to the CalendarEvent to fill the calendar
            $calendar->addEvent($Event);
        }
    }
}