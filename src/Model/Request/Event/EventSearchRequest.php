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

    /** @var string|null */
    public $query;

    /** @var \DateTime|null */
    public $startDate;

    /** @var \DateTime|null */
    public $endDate;

    /** @var bool */
    public $isNotOnlyUpcoming = true;

    /** @var bool */
    public $isRegistrationOpened = false;

    /** @var int */
    public $page = 1;

    /** @var int */
    public $limit = 10;

    public function getQueryString(string $relativeTo): string
    {
        if (!$this->locale) {
            throw new \LogicException(sprintf('Locale must be set before %s method call!', __METHOD__));
        }

        $data['text'] = $this->query ?: null;
        $data['startDate'] = $this->startDate instanceof \DateTime ? $this->startDate->format('Y-m-d') : null;
        $data['endDate'] = $this->endDate instanceof \DateTime ? $this->endDate->format('Y-m-d') : null;
        $data['isNotOnlyUpcoming'] = $this->isNotOnlyUpcoming ?: true;
        $data['registrationStatus'] = $this->isRegistrationOpened ? 1 : 0;
        $data['page'] = $this->page ?: 1;
        $data['limit'] = $this->limit ?: 10;

        return $relativeTo.sprintf('/open-api/v1/%s/event/events', $this->locale).'?'.http_build_query($data);
    }
}