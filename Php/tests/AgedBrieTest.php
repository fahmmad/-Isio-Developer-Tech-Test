<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\Items\AgedBrie;
use PHPUnit\Framework\TestCase;

class AgedBrieTest extends TestCase
{
    public function testAgedBrieCreated(): void
    {
        $sellIn = 2;
        $quality = 5;
        $item = new AgedBrie($sellIn, $quality);
        
        $this->assertSame('Aged Brie', $item->name, "wrong item was created");
    }

    // Aged Brie" actually increases in Quality the older it gets
    public function testQualityIncrease(): void
    {
        $sellIn = 2;
        $quality = 5;
        $item = new AgedBrie($sellIn, $quality);
     
        $item->update();

        $this->assertLessThan($sellIn, $item->sellIn, "sellIn didn't descrease");
        $this->assertGreaterThan($quality, $item->quality, "quality didn't increase");
    }

    // The Quality of an item is never more than 40
    public function testQualityMaximumValue(): void
    {
        $sellIn = 2;
        $quality = 35;
        $days = 10;

        $item = new AgedBrie($sellIn, $quality);
     
         while($days > 0) {
            $item->update();
            $days--;
        }

        $this->assertLessThanOrEqual($item::MAX_QUALITY, $item->quality, "didn't respect the maximum value");
    }
}
