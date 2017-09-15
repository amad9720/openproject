<?php

namespace Als\PlateformBundle\Antispam;


class AlsAntispam
{
    private $mailer;
    private $local;
    private $minLength;

    public function __construct(\Swift_Mailer $mailer, $local, $minLength)
    {
        $this->mailer = $mailer;
        $this->local = $local;
        $this->minLength = (int) $minLength;
    }

    public function isSpam($text)
    {
        return strlen($text) < $this->minLength;
    }
}