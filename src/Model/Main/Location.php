<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 19.09.17 14:19.
 */

namespace Sci\API\Client\Model\Main;

class Location
{
    /** @var int */
    public $id;

    /** @var string */
    public $title;

    /** @var Location */
    public $parent;
}