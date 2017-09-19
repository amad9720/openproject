<?php

namespace Sup\TestBundle\Entity;


class FruitList
{
    private $orange;
    private $tomate;
    private $banane;

    /**
     * @return mixed
     */
    public function getOrange()
    {
        return $this->orange;
    }

    /**
     * @param mixed $orange
     */
    public function setOrange($orange)
    {
        $this->orange = $orange;
    }

    /**
     * @return mixed
     */
    public function getTomate()
    {
        return $this->tomate;
    }

    /**
     * @param mixed $tomate
     */
    public function setTomate($tomate)
    {
        $this->tomate = $tomate;
    }

    /**
     * @return mixed
     */
    public function getBanane()
    {
        return $this->banane;
    }

    /**
     * @param mixed $banane
     */
    public function setBanane($banane)
    {
        $this->banane = $banane;
    }


}