<?php

namespace Sup\TestBundle\Entity;


class Health
{
    protected $orangeFruit;
    protected $tomateFruit;
    protected $bananeFruit;

    /**
     * Health constructor.
     * @internal param $orangeFruit
     * @internal param $tomateFruit
     * @internal param $bananeFruit
     */
    public function __construct()
    {
        $this->orangeFruit = new Fruit('Orange',100);
        $this->tomateFruit = new Fruit('Tomate',125);
        $this->bananeFruit = new Fruit('Banane',300);
    }

    /**
     * @return mixed
     */
    public function getOrangeFruit()
    {
        return $this->orangeFruit;
    }

    /**
     * @param mixed $orangeFruit
     */
    public function setOrangeFruit($orangeFruit)
    {
        $this->orangeFruit = $orangeFruit;
    }

    /**
     * @return mixed
     */
    public function getTomateFruit()
    {
        return $this->tomateFruit;
    }

    /**
     * @param mixed $tomateFruit
     */
    public function setTomateFruit($tomateFruit)
    {
        $this->tomateFruit = $tomateFruit;
    }

    /**
     * @return mixed
     */
    public function getBananeFruit()
    {
        return $this->bananeFruit;
    }

    /**
     * @param mixed $bananeFruit
     */
    public function setBananeFruit($bananeFruit)
    {
        $this->bananeFruit = $bananeFruit;
    }

}