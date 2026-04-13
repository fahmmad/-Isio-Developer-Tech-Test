<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use GildedRose\GildedRose;
use GildedRose\Items\ItemFactory;


echo 'OMGHAI!' . PHP_EOL;

$items = [
    ItemFactory::create('+5 Dexterity Vest', 10, 20),
    ItemFactory::create('Aged Brie', 2, 0),
    ItemFactory::create('Elixir of the Mongoose', 5, 7),
    ItemFactory::create('Sulfuras, Hand of Ragnaros', 0, 80),
    ItemFactory::create('Sulfuras, Hand of Ragnaros', -1, 80),
    ItemFactory::create('Backstage passes to a TAFKAL80ETC concert', 15, 20),
    ItemFactory::create('Backstage passes to a TAFKAL80ETC concert', 10, 49),
    ItemFactory::create('Backstage passes to a TAFKAL80ETC concert', 5, 49),
    ItemFactory::create('Conjured Mana Cake', 3, 6),
];

$app = new GildedRose($items);

$days = 2;
if ((is_countable($argv) ? count($argv) : 0) > 1) {
    $days = (int) $argv[1];
}

for ($i = 0; $i < $days; $i++) {
    echo "-------- day {$i} --------" . PHP_EOL;
    echo 'name, sellIn, quality' . PHP_EOL;
    foreach ($items as $item) {
        echo $item . PHP_EOL;
    }
    echo PHP_EOL;
    $app->updateQuality();
}
