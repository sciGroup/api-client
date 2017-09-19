<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 19.09.17 14:09.
 */

namespace Sci\API\Client\Model\Request\Event;

use Sci\API\Client\Model\Request\RequestInterface;

class EventSearchRequest implements RequestInterface
{
    /** @var string */
    public $locale;

    /** @var string */
    public $query;

    /** @var \DateTime */
    public $startDate;

    /** @var \DateTime */
    public $endDate;

    /** @var bool */
    public $isNotOnlyUpcoming;

    /** @var bool */
    public $isRegistrationOpened;

    /** @var int */
    public $page;

    /** @var int */
    public $limit;

    public function getQuery(): string
    {

    }
}