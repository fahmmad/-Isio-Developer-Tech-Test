<?php

declare(strict_types=1);

namespace GildedRose\Items;

use GildedRose\Items\ {
    AgedBrie,
    BackstagePasses,
    ItemGeneral,
    Sulfuras,
    Conjured
};

class ItemFactory
{
    public static function create(
        string $name,
        int $sellIn,
        int $quality
    ) {
        return match($name) {
            'Aged Brie'                     => new AgedBrie($sellIn, $quality),
            'Sulfuras, Hand of Ragnaros'    => new Sulfuras($sellIn, $quality),
            'Backstage passes to a TAFKAL80ETC concert' => new BackstagePasses($sellIn, $quality),
            'Conjured Mana Cake'            => new Conjured($sellIn, $quality),
            default                         => new ItemGeneral($name, $sellIn, $quality),
        };
    }    
}
