<?php
namespace GildedRose\Interfaces;

interface QualityStrategy 
{
    const MIN_QUALITY = 0;
    const MAX_QUALITY = 40;

    public function update();
}

