<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\Items\Sulfuras;
use PHPUnit\Framework\TestCase;

class SulfurasTest extends TestCase
{
    public function testSulfurasCreated(): void
    {
        $sellIn = 2;
        $quality = 5;
        $item = new Sulfuras($sellIn, $quality);
        
        $this->assertSame('Sulfuras, Hand of Ragnaros', $item->name, "wrong item was created");
    }

    // being a legendary item, never has to be sold or decreases in Quality
    public function testQualityIncrease(): void
    {
        $sellIn = 2;
        $quality = 5;
        $item = new Sulfuras($sellIn, $quality);
     
        $item->update();

        $this->assertSame($quality, $item->quality, "quality value changed");
    }

    // being a legendary item, never has to be sold or decreases in Quality
    public function testSellInIncrease(): void
    {
        $sellIn = 2;
        $quality = 5;
        $item = new Sulfuras($sellIn, $quality);
     
        $item->update();

        $this->assertSame($sellIn, $item->sellIn, "sellIn value changed");
    }
}
