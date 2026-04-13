<?php
declare(strict_types=1);

namespace GildedRose\Items;

use GildedRose\Interfaces\QualityStrategy;
use GildedRose\Item;

class ItemGeneral extends Item implements QualityStrategy 
{
     public function __construct(
        public string $name,
        public int $sellIn,
        public int $quality
    ) {
        // The Quality of an item is never more than 40
        $quality = $quality > self::MAX_QUALITY ? self::MAX_QUALITY : $quality;
        parent::__construct($name, $sellIn, $quality);
    }

    public function update() 
    {
        // At the end of each day our system lowers both values for every item
        $this->sellIn--;
        $this->descreaseQuality();

        // Once the sell by date has passed, Quality degrades twice as fast
        if($this->sellIn < 0) {
            $this->descreaseQuality();
        }
    }

    private function descreaseQuality() 
    {
        // The Quality of an item is never negative
        if($this->quality - 1 >= self::MIN_QUALITY) {
            $this->quality--;
        }
    }
}
