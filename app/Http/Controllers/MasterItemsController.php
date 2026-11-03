<?php

namespace App\Http\Controllers;

use App\Models\MasterItem;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Log;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class MasterItemsController extends Controller
{
    public function index()
    {
        return view('master_items.index.index');
    }

    public function search(Request $request)
    {
        // dd($request->all());
        // Log::info('Request Search:', $request->all());

        $kode = $request->kode;
        $nama = $request->nama;
        $hargamin = $request->hargamin;
        $hargamax = $request->hargamax;

        $data_search = MasterItem::query();

        if (!empty($kode)) $data_search = $data_search->where('kode', $kode);
        if (!empty($nama)) $data_search = $data_search->where('nama', 'LIKE', '%' . $nama . '%');
        // if (!empty($hargamin)) $data_search = $data_search->where('harga_beli', '>=', $hargamin)->where('harga_beli', '<=', $hargamax);
        if ($request->filled('hargamin')) {
            $data_search->where(
                'harga_beli',
                '>=',
                $request->hargamin
            );
        }

        if ($request->filled('hargamax')) {
            $data_search->where(
                'harga_beli',
                '<=',
                $request->hargamax
            );
        }

        $data_search = $data_search->select('kode', 'nama', 'jenis', 'harga_beli', 'laba', 'supplier')->orderBy('id')->get();


        return json_encode([
            'status' => 200,
            'data' => $data_search
        ]);
    }

    public function formView($method, $id = 0)
    {
        // if ($method == 'new') {
        //     $item = [];
        // } else {
        //     $item = MasterItem::find($id);
        // }
        // $data['item'] = $item;
        // $data['method'] = $method;
        // return view('master_items.form.index', $data);
        if ($method === 'new') {
            $item = new MasterItem();
        } else {
            $item = MasterItem::with('categories')->findOrFail($id);
        }

        $categories = Category::orderBy('name')->get();

        return view('master_items.form.index', [
            'item' => $item,
            'method' => $method,
            'categories' => $categories,
        ]);
    }

    public function singleView($kode)
    {
        $data['data'] = MasterItem::where('kode', $kode)->first();
        return view('master_items.single.index', $data);
    }

    
    public function formSubmit(Request $request, $method, $id = 0)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'harga_beli' => 'required|integer|min:0',
            'laba' => 'required|numeric|min:0',
            'supplier' => 'required|string',
            'jenis' => 'required|string',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($method === 'new') {
            $data_item = new MasterItem();

            $data_item->kode = str_pad(
                ((int) MasterItem::withTrashed()->max('id')) + 1,
                5,
                '0',
                STR_PAD_LEFT
            );
        } else {
            $data_item = MasterItem::findOrFail($id);
        }

        $data_item->nama = $validated['nama'];
        $data_item->harga_beli = $validated['harga_beli'];
        $data_item->laba = $validated['laba'];
        $data_item->supplier = $validated['supplier'];
        $data_item->jenis = $validated['jenis'];

        // Upload foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika tersedia
            if ($data_item->foto) {
                Storage::disk('public')->delete($data_item->foto);
            }

            $data_item->foto = $request->file('foto')
                ->store('master-items', 'public');
        }

        $data_item->save();

        $data_item->categories()->sync(
            $validated['categories'] ?? []
        );

        return redirect('master-items');
    }

    public function delete($id)
    {
        MasterItem::find($id)->delete();
        return redirect('master-items');
    }

    public function updateRandomData()
    {
        $data = MasterItem::get();
        foreach($data as $item)
        {
            $kode = $item->id;
            $kode = str_pad($kode, 5, '0', STR_PAD_LEFT);

            $item->harga_beli = rand(100,1000000);
            $item->laba = rand(10,99);
            $item->kode = $kode;
            $item->supplier = $this->getRandomSupplier();
            $item->jenis = $this->getRandomJenis();
            $item->save();
        }
    }

    private function getRandomSupplier()
    {
        $array = ['Tokopaedi','Bukulapuk','TokoBagas','E Commurz','Blublu'];
        $random = rand(0,4);
        return $array[$random];
    }

    private function getRandomJenis()
    {
        $array = ['Obat','Alkes','Matkes','Umum','ATK'];
        $random = rand(0,4);
        return $array[$random];
    }
}
