<?php
/**
 * Created by PhpStorm.
 * User: brahim
 * Date: 14/11/2018
 * Time: 18:03
 */

namespace App\Entity;



class PropertySearch
{
    /**
     * @var Integer $maxPrice
     */
    private $maxPrice;

    /**
     * @var Integer $minSurface
     */
    private $minSurface;

    /**
     * @return int
     */
    public function getMaxPrice()
    {
        return $this->maxPrice;
    }

    /**
     * @param int $maxPrice
     */
    public function setMaxPrice(int $maxPrice): void
    {
        $this->maxPrice = $maxPrice;
    }

    /**
     * @return int
     */
    public function getMinSurface()
    {
        return $this->minSurface;
    }

    /**
     * @param int $minSurface
     */
    public function setMinSurface(int $minSurface): void
    {
        $this->minSurface = $minSurface;
    }

}