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

                if ($item->name != 'Aged Brie' and $item->name != 'Backstage passes to a TAFKAL80ETC concert') {
                    if ($item->quality > 0) {
                        $item->quality = $item->quality - 1;
                    }
                } else {
                    if ($item->quality < 50) {
                        $item->quality = $item->quality + 1;
                        if ($item->name == 'Backstage passes to a TAFKAL80ETC concert') {
                            if ($item->sell_in < 11) {
                                if ($item->quality < 50) {
                                    $item->quality = $item->quality + 1;
                                }
                            }
                            if ($item->sell_in < 6) {
                                if ($item->quality < 50) {
                                    $item->quality = $item->quality + 1;
                                }
                            }
                        }
                    }
                }
    
                $item->sell_in = $item->sell_in - 1;
    
                if ($item->sell_in < 0) {
                    if ($item->name != 'Aged Brie') {
                        if ($item->name != 'Backstage passes to a TAFKAL80ETC concert') {
                            if ($item->quality > 0) {
                                $item->quality = $item->quality - 1;
                            }
                        } else {
                            $item->quality = $item->quality - $item->quality;
                        }
                    } else {
                        if ($item->quality < 50) {
                            $item->quality = $item->quality + 1;
                        }
                    }
                }

                return $item;
            },
            $this->items
        );
    }
}
