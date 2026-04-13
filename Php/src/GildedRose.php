<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Interfaces\QualityStrategy;

final class GildedRose
{
    /**
     * @param QualityStrategy[] $items
     */
    public function __construct(
        private array $items
    ) {
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            $item->update();
        }
    }
}
