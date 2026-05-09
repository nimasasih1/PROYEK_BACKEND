<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SyaratKetentuan;

class SyaratKetentuanControllers extends Controller
{
    /* ================= INDEX ================= */
    public function syaratIndex()
    {
        $syarat = \App\Models\SyaratItem::orderBy('order_number', 'asc')->get();
        return view('viewmahasiswa.syarat_admin', compact('syarat'));
    }

    /* ================= STORE ================= */
    public function syaratStore(Request $request)
    {
        $request->validate([
            'order_number'   => 'required|integer',
            'title_id'       => 'required|string',
            'description_id' => 'required|string',
            'title_en'       => 'nullable|string',
            'description_en' => 'nullable|string',
            'icon'           => 'nullable|string',
            'color'          => 'nullable|string',
        ]);

        $data = $request->all();
        $data['title_en'] = $data['title_en'] ?? '-';
        $data['description_en'] = $data['description_en'] ?? '-';
        $data['icon'] = $data['icon'] ?? 'bi-check2-square';
        $data['color'] = $data['color'] ?? '#6c757d';

        \App\Models\SyaratItem::create($data);

        return redirect()->back()->with('success_swal', true);
    }

    /* ================= SHOW (AJAX EDIT) ================= */
    public function syaratShow($id)
    {
        return response()->json(
            \App\Models\SyaratItem::findOrFail($id)
        );
    }

    /* ================= UPDATE ================= */
    public function syaratUpdate(Request $request, $id)
    {
        $item = \App\Models\SyaratItem::findOrFail($id);

        $request->validate([
            'order_number'   => 'required|integer',
            'title_id'       => 'required|string',
            'description_id' => 'required|string',
            'title_en'       => 'nullable|string',
            'description_en' => 'nullable|string',
            'icon'           => 'nullable|string',
            'color'          => 'nullable|string',
        ]);

        $item->update($request->all());

        return redirect()->back()->with('success1_swal', true);
    }

    /* ================= DELETE ================= */
    public function syaratDestroy($id)
    {
        $data = \App\Models\SyaratItem::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('success2_swal', true);
    }
}
