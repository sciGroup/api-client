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

    public function getQuery(string $relativeTo): string
    {
        if (!$this->locale) {
            throw new \LogicException(sprintf('Locale must be set before %s method call!', __METHOD__));
        }

        $data['text'] = $this->query ?: null;
        $data['startDate'] = $this->startDate instanceof \DateTime ? $this->startDate->format('Y-m-d') : null;
        $data['endDate'] = $this->endDate instanceof \DateTime ? $this->endDate->format('Y-m-d') : null;

        return $relativeTo.sprintf('/open-api/v1/%s/event/events', $this->locale).http_build_query($data);
    }
}