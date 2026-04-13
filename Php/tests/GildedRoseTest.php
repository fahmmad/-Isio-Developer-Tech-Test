<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Items\ItemGeneral;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function testExample(): void
    {
        $items = [new ItemGeneral('foo', 0, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('foo', $items[0]->name);
    }
}
