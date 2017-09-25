<?php

/**
 * le Join Column de la ligne 35 est la pour interdire la création d'une candidature sans annonce
 */

namespace Als\PlateformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Application
 *
 * @ORM\Table(name="application")
 * @ORM\Entity(repositoryClass="Als\PlateformBundle\Repository\ApplicationRepository")
 */

class Application
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Bidirectional - Many-To-One (OWNER SIDE)
     *
     * @var Advert
     *
     * @ORM\ManyToOne(targetEntity="Als\PlateformBundle\Entity\Advert", inversedBy="applications")
     * @ORM\JoinColumn(nullable=false)
     */
    private $advert;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=50)
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;


    /**
     * Application constructor.
     */
    public function __construct()
    {
        $this->date = date_create(); // new \Datetime()
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param string $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }



    /**
     * Set advert
     *
     * @param \Als\PlateformBundle\Entity\Advert $advert
     *
     * @return Application
     */
    public function setAdvert(Advert $advert)
    {
        $this->advert = $advert;

        return $this;
    }

    /**
     * Get advert
     *
     * @return \Als\PlateformBundle\Entity\Advert
     */
    public function getAdvert()
    {
        return $this->advert;
    }

    /**
     * @ORM\PrePersist()
     */
    public function increase()
    {
        $this->getAdvert()->increaseApplication();

        return $this;
    }

    /**
     * @ORM\PreRemove()
     */
    public function decrease()
    {
        $this->getAdvert()->decreaseApplication();

        return $this;
    }
}
