<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\Items\Conjured;
use PHPUnit\Framework\TestCase;

class ConjuredTest extends TestCase
{
    // Test the item has a SellIn value and that it goes down at the end of each day
    public function testHasSellIn(): void
    {
        $sellIn = 2;
        $quality = 5;
        $item = new Conjured($sellIn, $quality);
        $this->assertSame($sellIn, $item->sellIn, "sellIn not found");
        
        $item->update();

        $this->assertLessThan($sellIn, $item->sellIn, "sellIn didn't descrease");
    }

    // test the item has a quality value and that it goes down at the end of each day by 2
    public function testHasQuality(): void
    {
        $sellIn = 2;
        $quality = 5;
        $item = new Conjured($sellIn, $quality);
        $this->assertSame($quality, $item->quality, "quality not found");
        
        $item->update();
        
        $this->assertSame($quality-2, $item->quality, "quality didn't descrease by 2");
    }

    // test the Quality of an item is never more than 40
    public function testQualityIsNeverMoreThan40(): void
    {
        $sellIn = 2;
        $quality = 45;
        $item = new Conjured($sellIn, $quality);
        $this->assertSame(Conjured::MAX_QUALITY, $item->quality, "quality is more than allowed value");
        
        $item->update();
        
        $this->assertLessThanOrEqual(Conjured::MAX_QUALITY, $item->quality, "quality is more than allowed value");
    }

    // test: Once the sell by date has passed, Quality degrades twice as fast
    public function testQualityAfterExpiry(): void
    {
        $sellIn = 1;
        $quality = 10;
        $days = 2;
        $item = new Conjured($sellIn, $quality);
        
        while($days > 0) {
            $item->update();
            $days--;
        }
        $this->assertSame($quality-6, $item->quality, "decreasing quality after expirty is wrong");
    }

    // test: The Quality of an item is never negative
    public function testQualityNeverNegative(): void
    {
        $sellIn = 1;
        $quality = 5;
        $days = 5;
        $item = new Conjured($sellIn, $quality);
        
        $this->assertGreaterThanOrEqual(0, $item->quality, "quality is negative");

        while($days > 0) {
            $item->update();
            $days--;
        }
        
        $this->assertGreaterThanOrEqual(0, $item->quality, "quality is negative");
    }
}
