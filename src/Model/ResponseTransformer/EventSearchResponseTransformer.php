<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 21.09.17 11:02.
 */

namespace Sci\API\Client\Model\ResponseTransformer;

use Psr\Http\Message\ResponseInterface;
use Sci\API\Client\Model\Event\Event;
use Sci\API\Client\Model\Main\Location;
use Sci\API\Client\Model\Wrapper\EventSearchResponseWrapper;

class EventSearchResponseTransformer implements ResponseTransformerInterface
{
    /**
     * @param ResponseInterface $response
     * @return EventSearchResponseWrapper
     */
    public function transform(ResponseInterface $response)
    {
        $r = json_decode($response->getBody(), true);

        $events = [];
        foreach ($r['events'] as $e) {
            $event = new Event();
            $event->id = $e['id'];
            $event->defaultDomainLink = $e['default_domain_link'];
            $event->typeString = $e['type_string'];
            $event->attendanceType = $e['attendance_type_string'];
            $event->shortName = $e['short_name'];
            $event->fullName = $e['full_name'];
            $event->logo = $e['logo_url'];
            $event->registrationStartDate = $e['registration_start_date'] ? new \DateTime($e['registration_start_date']) : null;
            $event->registrationEndDate = $e['registration_end_date'] ? new \DateTime($e['registration_end_date']) : null;
            $event->eventStartDate = new \DateTime($e['event_start_date']);
            $event->eventEndDate = new \DateTime($e['event_end_date']);
            $event->isRegistrationOpened = $e['registration_status'] == 1;
            $event->location = $this->transformLocation($e['location']);

            $events[] = $event;
        }

        return new EventSearchResponseWrapper($r['hits'], $r['strict'], $events);
    }

    private function transformLocation(array $location): Location
    {
        $l = new Location();
        $l->id = $location['id'];
        $l->title = $location['title'];
        if (isset($location['parent'])) {
            $l->parent = $this->transformLocation($location['parent']);
        }

        return $l;
    }
}