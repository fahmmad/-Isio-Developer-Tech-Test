<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\Items\BackstagePasses;
use PHPUnit\Framework\TestCase;

class BackstagePassesTest extends TestCase
{
    public function testBackstagePassesCreated(): void
    {
        $sellIn = 2;
        $quality = 5;
        $item = new BackstagePasses($sellIn, $quality);
        
        $this->assertSame('Backstage passes to a TAFKAL80ETC concert', $item->name, "wrong item was created");
    }

    // BackstagePasses increases in Quality
    public function testQualityIncrease(): void
    {
        $sellIn = 10;
        $quality = 5;
        $item = new BackstagePasses($sellIn, $quality);
     
        $item->update();

        $this->assertSame($quality + 1, $item->quality, "quality should increase by 1");
    }

    // Quality increases by 3 when there are 7 days or less and by 4 when there are 2 days or less but
    public function testQualityWhenLessThan7Days(): void
    {
        $sellIn = 7;
        $quality = 5;
        $item = new BackstagePasses($sellIn, $quality);
     
        $item->update();

        $this->assertSame($quality + 3, $item->quality, "quality should increase by 1");
    }

    // Test the Quality doesn't increases by 3 when there are 2 days or less but
    public function testQualityDoesntIncreaseBy3WhenLessThan2Days(): void
    {
        $sellIn = 2;
        $quality = 5;
        $item = new BackstagePasses($sellIn, $quality);
     
        $item->update();

        $this->assertNotSame($quality + 3, $item->quality, "quality should increase by 4");
    }

    // Quality increases by 4 when there are 2 days or less but
    public function testQualityWhenLessThan2Days(): void
    {
        $sellIn = 2;
        $quality = 5;
        $item = new BackstagePasses($sellIn, $quality);
     
        $item->update();

        $this->assertSame($quality + 4, $item->quality, "quality should increase by 1");
    }

    // The Quality drops to 0 after the concert
    public function testQualityDropsAfterExpiry(): void
    {
        $sellIn = 2;
        $quality = 35;
        $days = 3;

        $item = new BackstagePasses($sellIn, $quality);
     
         while($days > 0) {
            $item->update();  
            $days--;
        }

        $this->assertSame($item::MIN_QUALITY, $item->quality, "quality didn't drop to 0");
    }
}
