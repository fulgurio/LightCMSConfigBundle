<?php
/*
 * This file is part of the LightCMSConfigBundle package.
 *
 * (c) Fulgurio <http://fulgurio.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fulgurio\LightCMSConfigBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Config
 */
class Config
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $meta_type;

    /**
     * @var string
     */
    private $meta_key;

    /**
     * @var string
     */
    private $meta_value;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $updated_at;


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
     * Set meta_type
     *
     * @param string $metaType
     * @return Config
     */
    public function setMetaType($metaType)
    {
        $this->meta_type = $metaType;

        return $this;
    }

    /**
     * Get meta_type
     *
     * @return string
     */
    public function getMetaType()
    {
        return $this->meta_type;
    }

    /**
     * Set meta_key
     *
     * @param string $metaKey
     * @return Config
     */
    public function setMetaKey($metaKey)
    {
        $this->meta_key = $metaKey;

        return $this;
    }

    /**
     * Get meta_key
     *
     * @return string
     */
    public function getMetaKey()
    {
        return $this->meta_key;
    }

    /**
     * Set meta_value
     *
     * @param string $metaValue
     * @return Config
     */
    public function setMetaValue($metaValue)
    {
        $this->meta_value = $metaValue;

        return $this;
    }

    /**
     * Get meta_value
     *
     * @return string
     */
    public function getMetaValue()
    {
        return $this->meta_value;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Config
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return Config
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
}
