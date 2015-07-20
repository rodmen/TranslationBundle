<?php
namespace Acilia\Bundle\TranslationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="translation_attribute", uniqueConstraints={@ORM\UniqueConstraint(name="unq_translation_attribute", columns={"attrib_node", "attrib_name"})}, options={"collate"="utf8_unicode_ci", "charset"="utf8", "engine"="InnoDB"})
 */
class TranslationAttribute
{
    /**
     * @ORM\Column(name="attrib_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="TranslationNode")
     * @ORM\JoinColumn(name="attrib_node", referencedColumnName="node_id", nullable=false)
     */
    protected $node;

    /**
     * @ORM\Column(name="attrib_name", type="string", length=64)
     */
    protected $name;

    /**
     * @ORM\Column(name="attrib_original", type="text")
     */
    protected $original;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param  string $name
     * @return TranslationAttribute
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set original
     *
     * @param  string $original
     * @return TranslationAttribute
     */
    public function setOriginal($original)
    {
        $this->original = $original;

        return $this;
    }

    /**
     * Get original
     *
     * @return string
     */
    public function getOriginal()
    {
        return $this->original;
    }

    /**
     * Set node
     *
     * @param  \Acilia\Bundle\TranslationBundle\Entity\TranslationNode $node
     * @return TranslationAttribute
     */
    public function setNode(\Acilia\Bundle\TranslationBundle\Entity\TranslationNode $node = null)
    {
        $this->node = $node;

        return $this;
    }

    /**
     * Get node
     *
     * @return \Acilia\Bundle\TranslationBundle\Entity\TranslationNode
     */
    public function getNode()
    {
        return $this->node;
    }
}
