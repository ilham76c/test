<?php

namespace App\Exports;

use App\Models\MasterItem;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MasterItemsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $items = MasterItem::with('categories')
            ->orderBy('nama')
            ->get();

        return $items->values()->map(function ($item, $index) {
            $harga = (float) $item->harga_beli;
            $laba = (float) $item->laba;

            $hargaJual = $harga + ($harga * $laba / 100);

            return [
                $index + 1,
                $item->categories->pluck('name')->implode(', '),
                $item->nama,
                $item->supplier,
                $harga,
                $laba . '%',
                $hargaJual,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama kategori',
            'Nama items',
            'Nama supplier',
            'Harga',
            'Laba',
            'Harga jual',
        ];
    }
}
