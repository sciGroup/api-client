<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 21.09.17 11:06.
 */

namespace Sci\API\Client\Model\Wrapper;

class EventSearchResponseWrapper
{
    private $hits;
    private $strict;
    private $events;

    public function __construct($hits, $strict, $events)
    {
        $this->hits = $hits;
        $this->strict = $strict;
        $this->events = $events;
    }

    /**
     * @return mixed
     */
    public function getHits()
    {
        return $this->hits;
    }

    /**
     * @return mixed
     */
    public function getStrict()
    {
        return $this->strict;
    }

    /**
     * @return mixed
     */
    public function getEvents()
    {
        return $this->events;
    }
}