<?php
namespace Acilia\Bundle\TranslationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="translation_value", uniqueConstraints={
 *     @ORM\UniqueConstraint(name="unq_translation_value", columns={"value_resource", "value_attribute"})}
 * )
 * @ORM\HasLifecycleCallbacks()
 */

class TranslationValue
{
    /**
     * @ORM\Column(name="value_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="TranslationAttribute")
     * @ORM\JoinColumn(name="value_attribute", referencedColumnName="attrib_id", nullable=false)
     */
    protected $attribute;

    /**
     * @ORM\Column(name="value_resource", type="string", length=16)
     */
    protected $resource;

    /**
     * @ORM\Column(name="value_translation", type="text")
     */
    protected $translation;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="value_created_at", type="datetime", nullable=false)
     */
    protected $createdAt;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="value_modified_at", type="datetime", nullable=false)
     */
    protected $modifiedAt;

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTime();
        $this->modifiedAt = new \DateTime();
    }

    /**
     * @ORM\PreUpdate
     */
    public function setModifiedAtValue()
    {
        $this->modifiedAt = new \DateTime();
    }
    
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
     * Set translation
     *
     * @param  string $translation
     * @return TranslationValue
     */
    public function setTranslation($translation)
    {
        $this->translation = $translation;

        return $this;
    }

    /**
     * Get translation
     *
     * @return string
     */
    public function getTranslation()
    {
        return $this->translation;
    }

    /**
     * Set resource
     *
     * @param  string $resource
     * @return TranslationValue
     */
    public function setResource($resource)
    {
        $this->resource = $resource;

        return $this;
    }

    /**
     * Get resource
     *
     * @return string
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Set attribute
     *
     * @param  \Acilia\Bundle\TranslationBundle\Entity\TranslationAttribute $attribute
     * @return TranslationValue
     */
    public function setAttribute(\Acilia\Bundle\TranslationBundle\Entity\TranslationAttribute $attribute = null)
    {
        $this->attribute = $attribute;

        return $this;
    }

    /**
     * Get attribute
     *
     * @return \Acilia\Bundle\TranslationBundle\Entity\TranslationAttribute
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * Set createdAt
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get createdAt
     *
     * @return datetime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set modifiedAt
     *
     * @param datetime $modifiedAt
     */
    public function setModifiedAt($modifiedAt)
    {
        $this->modifiedAt = $modifiedAt;
    }

    /**
     * Get transValueModifiedAt
     *
     * @return datetime
     */
    public function getModifiedAt()
    {
        return $this->modifiedAt;
    }
}
