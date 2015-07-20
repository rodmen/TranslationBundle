<?php
namespace Acilia\Bundle\TranslationBundle\Event;

use Acilia\Bundle\TranslationBundle\Event\ResourceEvent;
use Symfony\Component\EventDispatcher\Event;

class ResourcesEvent extends Event
{
    /**
     * @var array
     */
    protected $resources;

    public function __construct()
    {
        $this->resources = [];
    }

    /**
     * Adds an event
     * @param $resources ResourceEvent
     * @return ResourcesEvent
     */
    public function addResource(ResourceEvent $resourceEvent)
    {
        $this->resources[] = $resourceEvent;
        return $this;
    }

    /**
     * Get the Resources
     * @return array
     */
    public function getResources()
    {
        return $this->resources;
    }
}