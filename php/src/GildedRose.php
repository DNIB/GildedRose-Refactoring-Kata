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

                $item->sell_in -= 1;

                switch ($item->name) {
                    case 'Aged Brie':
                        $item->quality += ($item->sell_in >= 0) ? 1 : 2;
                        break;

                    case 'Backstage passes to a TAFKAL80ETC concert':
                        if ($item->sell_in > 10) {
                            $item->quality += 1;
                        } elseif ($item->sell_in > 5) {
                            $item->quality += 2;
                        } elseif ($item->sell_in > 0) {
                            $item->quality += 3;
                        } else {
                            $item->quality = 0;
                        }
                        break;
                    
                    default:
                        $item->quality -= ($item->sell_in < 0) ? 2 : 1;
                        break;
                }

                if ($item->quality > 50) {
                    $item->quality = 50;
                } elseif ($item->quality < 0) {
                    $item->quality = 0;
                }

                return $item;
            },
            $this->items
        );
    }
}
