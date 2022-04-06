<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    /**
     * @var Item[]
     */
    private $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function updateQuality(): void
    {
        $this->items = array_map(
            function (Item $item): Item {
                if ($item->name === 'Sulfuras, Hand of Ragnaros') {
                    return $item;
                }

                if ($item->name === 'Aged Brie') {
                    $item->sell_in -= 1;

                    $item->quality += ($item->sell_in >= 0) ? 1 : 2;
                    $item->quality = ($item->quality <= 50) ? $item->quality : 50;
                    return $item;
                }

                if ($item->name === 'Backstage passes to a TAFKAL80ETC concert') {
                    $item->sell_in -= 1;

                    if ($item->sell_in > 10) {
                        $item->quality += 1;
                    } elseif ($item->sell_in > 5) {
                        $item->quality += 2;
                    } elseif ($item->sell_in > 0) {
                        $item->quality += 3;
                    } else {
                        $item->quality = 0;
                    }
                    $item->quality = ($item->quality <= 50) ? $item->quality : 50;
                    return $item;
                }

                if ($item->quality > 0) {
                    $item->quality = $item->quality - 1;
                }
    
                $item->sell_in = $item->sell_in - 1;
    
                if ($item->sell_in < 0) {
                    if ($item->quality > 0) {
                        $item->quality = $item->quality - 1;
                    }
                }

                return $item;
            },
            $this->items
        );
    }
}
