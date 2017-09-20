<?php

namespace Hlt\ManageurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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

    private $product_1;

    private $product_2;

    private $product_3;

    /**
     * Meal constructor.
     */
    public function __construct()
    {
        $this->creationDate = date_create();
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

//    /**
//     * Set creationDate
//     *
//     * @param \DateTime $creationDate
//     *
//     * @return Meal
//     */
//    public function setCreationDate($creationDate)
//    {
//        $this->creationDate = $creationDate;
//
//        return $this;
//    }
    /**
     * Get creationDate
     *
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @return mixed
     */
    public function getProduct1()
    {
        return $this->product_1;
    }

    /**
     * @param mixed $product_1
     */
    public function setProduct1($product_1)
    {
        $this->product_1 = $product_1;
    }

    /**
     * @return mixed
     */
    public function getProduct2()
    {
        return $this->product_2;
    }

    /**
     * @param mixed $product_2
     */
    public function setProduct2($product_2)
    {
        $this->product_2 = $product_2;
    }

    /**
     * @return mixed
     */
    public function getProduct3()
    {
        return $this->product_3;
    }

    /**
     * @param mixed $product_3
     */
    public function setProduct3($product_3)
    {
        $this->product_3 = $product_3;
    }


}
