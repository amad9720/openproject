<?php


namespace Hlt\ManageurBundle\HealthCheck;


use Hlt\ManageurBundle\Entity\Meal;

class HltHealthCheck
{
    public function isHealthy(Meal $meal)
    {
        $product1_Weight = $meal->getProduct1()->getWeight();
        $product2_Weight = $meal->getProduct2()->getWeight();
        $product3_Weight = $meal->getProduct3()->getWeight();

        return $product1_Weight + $product2_Weight + $product3_Weight > 1000 ? false : true;
    }
}