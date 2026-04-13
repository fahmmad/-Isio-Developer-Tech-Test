<?php
declare(strict_types=1);

namespace GildedRose\Items;

use GildedRose\Interfaces\QualityStrategy;
use GildedRose\Item;

class Sulfuras extends Item implements QualityStrategy 
{
    public function __construct(
        public int $sellIn,
        public int $quality
    ) {
        // The Quality of an item is never more than 40
        $quality = $quality > self::MAX_QUALITY ? self::MAX_QUALITY : $quality;
        parent::__construct('Sulfuras, Hand of Ragnaros', $sellIn, $quality);
    }

    public function update() 
    {
        // never has to be sold or decreases in Quality
    }
}