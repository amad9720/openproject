<?php

namespace Als\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AlsUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
