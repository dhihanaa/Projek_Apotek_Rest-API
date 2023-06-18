<?php

namespace App\Http\Controllers;

use App\Models\Apotek;
use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;

class ApotekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apotek = Apotek::all();

        if ($apotek) {
            return ApiFormatter::createApi(200, 'success', $apotek);
        } else {
            return ApiFormatter::createApi(400, 'failed');
        }

    }


    public function createToken()
    {
        return csrf_token();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required',
                'rujukan' => 'required',
                'rumah_sakit' => 'nullable',
                'obat' => 'required',
                'harga_satuan' => 'required',
                'apoteker' => 'required',
            ]);

            if ($request->rujukan == 1 && $request->rumah_sakit == null) {
                return ApiFormatter::createApi(400, 'The Given Data Was Infalied');
            }

            if (in_array(',', str_split($request->obat))) {
                $obat = explode(',', $request->obat);
            } else {
                $obat = $request->obat;
            }

            if (in_array(',', str_split($request->harga_satuan))) {
                $harga_satuan = explode(',', $request->harga_satuan);
                $total_harga = array_sum($harga_satuan);
            } else {
                $harga_satuan = $request->harga_satuan;
                $total_harga = $request->harga_satuan;
            }

            $apoteks = Apotek::create([
                'nama' => $request->nama,
                'rujukan' => $request->rujukan,
                'rumah_sakit' => $request->rumah_sakit,
                'obat' => $obat,
                'harga_satuan' => $harga_satuan,
                'total_harga' => $total_harga,
                'apoteker' => $request->apoteker,
            ]);

            $getDataSaved = Apotek::where('id', $apoteks->id)->first();

            if ($getDataSaved) {
                return ApiFormatter::createApi(200, 'success', $getDataSaved);
            } else {
                return ApiFormatter::createApi(400, 'fail');
            }
        } catch (Exception $error) {
            return ApiFormatter::createApi(400, 'failed', $error);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Apotek $apotek, $id)
    {
        try {
            $apotekDetail = Apotek::where('id', $id)->first();

            if ($apotekDetail) {
                return ApiFormatter::createApi(200, 'success', $apotekDetail);
            } else {
                return ApiFormatter::createApi(400, 'failed');
            }
        } catch (Exception $error) {
            return ApiFormatter::createApi(400, 'failed', $error);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apotek $apotek)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama' => 'required',
                'rujukan' => 'required',
                'rumah_sakit' => 'nullable',
                'obat' => 'required',
                'harga_satuan' => 'required',
                'apoteker' => 'required',
            ]);

            if (in_array(',', str_split($request->obat))) {
                $obat = explode(',', $request->obat);
            } else {
                $obat = $request->obat;
            }

            if (in_array(',', str_split($request->harga_satuan))) {
                $harga_satuan = explode(',', $request->harga_satuan);
                $total_harga = array_sum($harga_satuan);
            } else {
                $harga_satuan = $request->harga_satuan;
                $total_harga = $request->harga_satuan;
            }

            $apotek = Apotek::findOrFail($id);

            $apotek->update([
                'nama' => $request->nama,
                'rujukan' => $request->rujukan,
                'rumah_sakit' => $request->rumah_sakit,
                'obat' => $request->obat,
                'harga_satuan' => $request->harga_satuan,
                'total_harga' => $total_harga,
                'apoteker' => $request->apoteker,
            ]);

            $updatedApotek = Apotek::where('id', $apotek->id)->first();

            if ($updatedApotek) {
                return ApiFormatter::createApi(200, 'success', $updatedApotek);
            } else {
                return ApiFormatter::createApi(400, 'failed');
            }

        } catch (Exception $error) {
            return ApiFormatter::createApi(400, 'failed', $error);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $apotek = Apotek::findOrFail($id);
            $proses = $apotek->delete();

            if ($proses) {
                return ApiFormatter::createApi(200, 'Data Terhapus!');
            } else {
                return ApiFormatter::createApi(400, 'failed');
            }
        } catch (Exception $error) {
            return ApiFormatter::createApi(400, 'failed', $error);
        }
    }

    public function trash()
    {
        try {
            $trashAll = Apotek::onlyTrashed()->get();
            if ($trashAll) {
                return ApiFormatter::createApi(200, 'success', $trashAll);
            } else {
                return ApiFormatter::createApi(400, 'failed');
            }
        } catch (Exception $error) {
            return ApiFormatter::createApi(400, 'failed', $error);
        }
    }

    public function restore($id)
    {
        try {
            $apotek = Apotek::onlyTrashed()->where('id', $id);
            $apotek->restore();
            $dataRestore = Apotek::where('id', $id)->first();

            if ($dataRestore) {
                return ApiFormatter::createApi(200, 'success', $dataRestore);
            } else {
                return ApiFormatter::createApi(400, 'failed');
            }
        } catch (Execption $error) {
            return ApiFormatter::createApi(400, 'failed', $error);
        }
    }

    public function permanentDelete($id)
    {
        try {
            $apotek = Apotek::onlyTrashed()->where('id', $id);
            $proses = $apotek->forceDelete();
            if ($proses) {
                return ApiFormatter::createApi(200, 'success', 'Berhasil Hapus Data Permanent!');
            }else {
                return ApiFormatter::createApi(400, 'failed');
            }
        } catch (Exception $error) {
            return ApiFormatter::createApi(400, 'error', $error->getMessage());
        }
    }
    
}