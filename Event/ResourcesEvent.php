<?php
namespace Acilia\Bundle\TranslationBundle\Event;

use Acilia\Bundle\TranslationBundle\Event\ResourceEvent;
use Symfony\Component\EventDispatcher\Event;
use Countable;

class ResourcesEvent extends Event implements Countable
{
    /**
     * @var array
     */
    protected $resources;

    public function __construct()
    {
        $this->resources = [];
    }

    public function count()
    {
        return count($this->resources);
    }

    /**
     * Adds an event
     *
     * @param ResourceEvent $resourceEvent
     * @return ResourcesEvent
     */
    public function addResource(ResourceEvent $resourceEvent)
    {
        $this->resources[] = $resourceEvent;
        return $this;
    }

    /**
     * Get the Resources
     *
     * @return array
     */
    public function getResources()
    {
        return $this->resources;
    }
}