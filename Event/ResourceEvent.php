<?php
namespace Acilia\Bundle\TranslationBundle\Event;

class ResourceEvent
{
    const EVENT_WARMUP = 'translation.warmup';
    const EVENT_LOAD = 'translation.load';

    /**
     * @var string Resource Code
     */
    protected $resource;

    /**
     * @var string Culture
     */
    protected $culture;

    /**
     * @var int Version
     */
    protected $version;

    /**
     * Set the Resource Code
     * @param $resource string
     * @return ResourceEvent
     */
    public function setResource($resource)
    {
        $this->resource = $resource;
        return $this;
    }

    /**
     * Get the Resource Code
     * @return string
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Set the Culture
     * @param $culture string
     * @return ResourceEvent
     */
    public function setCulture($culture)
    {
        $this->culture = $culture;
        return $this;
    }

    /**
     * Get the Culture
     * @return string
     */
    public function getCulture()
    {
        return $this->culture;
    }

    /**
     * Set the Version
     * @param $version int
     * @return ResourceEvent
     */
    public function setVersion($version)
    {
        $this->version = (integer) $version;
        return $this;
    }

    /**
     * Get the Version
     * @return int
     */
    public function getVersion()
    {
        return $this->version;
    }
}