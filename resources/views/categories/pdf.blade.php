
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Detail Kategori {{ $category->name }}</title>

    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #333;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        .category-info {
            margin-bottom: 20px;
        }

        .category-info table {
            width: 100%;
        }

        .category-info td {
            padding: 5px;
        }

        table.items {
            width: 100%;
            border-collapse: collapse;
        }

        table.items th,
        table.items td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        table.items th {
            background-color: #eee;
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .footer {
            position: fixed;
            bottom: -25px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            color: #777;
        }
    </style>
</head>
<body>

    <h2>DETAIL KATEGORI ITEMS</h2>

    <div class="category-info">
        <table>
            <tr>
                <td width="120">Nama Kategori</td>
                <td width="10">:</td>
                <td>{{ $category->name }}</td>
            </tr>
            <tr>
                <td>Kode Kategori</td>
                <td>:</td>
                <td>{{ $category->code }}</td>
            </tr>
        </table>
    </div>

    <h4>Daftar Master Items</h4>

    <table class="items">
        <thead>
            <tr>
                <th width="40">No</th>
                <th>Nama Items</th>
                <th>Supplier</th>
                <th>Harga Beli</th>
                <th>Laba (%)</th>
            </tr>
        </thead>

        <tbody>
            @forelse($category->items as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->supplier }}</td>
                    <td>Rp {{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                    <td>{{ $item->laba }}%</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">
                        Tidak ada Master Items pada kategori ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ now()->format('d-m-Y H:i:s') }}
    </div>

</body>
</html>
