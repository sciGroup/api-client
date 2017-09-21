<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 19.09.17 14:15.
 */

namespace Sci\API\Client\Model\Event;

use Sci\API\Client\Model\Main\Location;

class Event
{
    /** @var int */
    public $id;

    /** @var string */
    public $defaultDomainLink;

    /** @var string */
    public $typeString;

    /** @var string */
    public $attendanceType;

    /** @var string */
    public $shortName;

    /** @var string */
    public $fullName;

    /** @var string */
    public $logo;

    /** @var \DateTime|null */
    public $registrationStartDate;

    /** @var \DateTime|null */
    public $registrationEndDate;

    /** @var \DateTime */
    public $eventStartDate;

    /** @var \DateTime */
    public $eventEndDate;

    /** @var bool */
    public $isRegistrationOpened;

    /** @var Location */
    public $location;
}