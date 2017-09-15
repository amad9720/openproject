<?php

namespace Sup\TestBundle\HealthCheck;


class SupHealthCheck
{
    public function isHealthy($result, $health)
    {
        $orangeNum = $result->getOrange();
        $orangeWeight = $health->getOrangeFruit()->getWeight();

        $tomateNum = $result->getTomate();
        $tomateWeight = $health->getTomateFruit()->getWeight();

        $bananeNum = $result->getBanane();
        $bananeWeight = $health->getBananeFruit()->getWeight();

        return
            ($bananeNum * $bananeWeight) +
            ($orangeNum * $orangeWeight) +
            ($tomateNum * $tomateWeight) > 1000 ? 'Repas Non Equilibree ' : 'Repas Equilibree';
    }
}