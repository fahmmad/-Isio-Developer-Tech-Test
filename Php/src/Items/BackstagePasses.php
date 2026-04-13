<?php
declare(strict_types=1);

namespace GildedRose\Items;
use GildedRose\Item;

class BackstagePasses extends AgedBrie
{
    public function __construct(
        public int $sellIn,
        public int $quality
    ) {
        // The Quality of an item is never more than 40
        $quality = $quality > self::MAX_QUALITY ? self::MAX_QUALITY : $quality;
        Item::__construct('Backstage passes to a TAFKAL80ETC concert', $sellIn, $quality);
    }

    public function update() 
    {
        // At the end of each day our system lowers both values for every item
        $this->sellIn--;

        if($this->sellIn <= 7) {
            // Quality increases by 3 when there are 7 days or less and by 4 when there are 2 days or less but
            if($this->sellIn <= 0) {
                // Quality drops to 0 after the concert
                $this->quality = 0;    
            } else if($this->sellIn <= 2) {
                $this->increaseQuality(4);
            } else {
                $this->increaseQuality(3);
            }
            
            return;
        }
        // "Backstage passes", like aged brie, increases in Quality as its SellIn value approaches;
        $this->increaseQuality();
    }

}