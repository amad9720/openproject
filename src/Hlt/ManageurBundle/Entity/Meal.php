<?php

namespace Hlt\ManageurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Meal
 *
 * @ORM\Table(name="meal")
 * @ORM\Entity(repositoryClass="Hlt\ManageurBundle\Repository\MealRepository")
 */
class Meal
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_healthy", type="boolean")
     */
    private $isHealthy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creationDate", type="datetime")
     */
    private $creationDate;

    /**
     * Meal constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->creationDate = new DateTime();
        $this->isHealthy = false;
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Meal
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
     * Set isHealthy
     *
     * @param boolean $isHealthy
     *
     * @return Meal
     */
    public function setIsHealthy($isHealthy)
    {
        $this->isHealthy = $isHealthy;

        return $this;
    }

    /**
     * Get isHealthy
     *
     * @return bool
     */
    public function getIsHealthy()
    {
        return $this->isHealthy;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     *
     * @return Meal
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }
}
