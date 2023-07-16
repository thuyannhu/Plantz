<?php

namespace App\EventSubscriber;

use App\Repository\BookingRepository;
use CalendarBundle\CalendarEvents;
use CalendarBundle\Entity\Event;
use CalendarBundle\Event\CalendarEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CalendarSubscriber implements EventSubscriberInterface
{
    public function __construct(private BookingRepository $bookingRepository, private UrlGeneratorInterface $router)
    {
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
        // Modify the query to fit your entity and needs
        // Change booking.beginAt by your start date property
        $bookings = $this->bookingRepository
            ->createQueryBuilder('booking')
            ->where('booking.arrivalDate BETWEEN :start and :end OR booking.departureDate BETWEEN :start and :end')
            ->setParameter('start', $start->format('Y-m-d'))
            ->setParameter('end', $end->format('Y-m-d'))
            ->getQuery()
            ->getResult();

        foreach ($bookings as $booking) {
            // Create the events with your data (here booking data) to fill the calendar
            $bookingEvent = new Event($booking->getUserFullName(), $booking->getArrivalDate(), $booking->getDepartureDate()); // If the end date is null or not defined, an all-day event is created.

            /*
             * Add custom options to events
             *
             * For more information see: https://fullcalendar.io/docs/event-object
             * and: https://github.com/fullcalendar/fullcalendar/blob/master/src/core/options.ts
             */
            $bookingEvent->setOptions([
                'backgroundColor' => '#D89393',
                'borderColor' => '#D89393',
            ]);

            $bookingEvent->addOption('url', $this->router->generate('app_booking_show', [
                'id' => $booking->getId(),
            ]));

            // Finally, add the event to the CalendarEvent to fill the calendar
            $calendar->addEvent($bookingEvent);
        }
    }
}
