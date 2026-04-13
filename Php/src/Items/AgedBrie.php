<?php
declare(strict_types=1);

namespace GildedRose\Items;

use GildedRose\Interfaces\QualityStrategy;
use GildedRose\Item;

class AgedBrie extends Item implements QualityStrategy 
{
    public function __construct(
        public int $sellIn,
        public int $quality
    ) {
        // The Quality of an item is never more than 40
        $quality = $quality > self::MAX_QUALITY ? self::MAX_QUALITY : $quality;
        parent::__construct('Aged Brie', $sellIn, $quality);
    }

    public function update() 
    {
        // At the end of each day our system lowers both values for every item
        $this->sellIn--;

        $this->increaseQuality(1);
    }

    protected function increaseQuality(int $increment = 1) 
    {
        // The Quality of an item is never more than 40
        if($this->quality + $increment <= self::MAX_QUALITY) {
            $this->quality+= $increment;
        }
    }
}
