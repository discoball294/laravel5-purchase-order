<?php

namespace App\Http\Controllers;

use App\PurchaseOrder;
use Illuminate\Http\Request;

$GLOBALS = array(
    'purchase' => new PurchaseOrder()
);

class PurchaseController extends Controller
{
    //


    public function purchaseOrder(Request $request)
    {
        $GLOBALS['purchase']->nama = $request['nama'];
        $GLOBALS['purchase']->alamat = $request['alamat'];
        $GLOBALS['purchase']->barang = $request['barang'];
        $GLOBALS['purchase']->bayar = $request['bayar'];
        $GLOBALS['purchase']->keterangan = $request['keterangan'];
        $saved = $GLOBALS['purchase']->save();

        if ($saved) {
            return response()
                ->json(['message' => 'Berhasil Simpan'])->header('Content-Type', 'text/json');
        } else {
            return response()
                ->json(['message' => 'Terjadi kesalahan saat simpan'])->header('Content-Type', 'text/json');
        }


    }

    public function getPurchase()
    {
        $purchases = PurchaseOrder::all();
        $parent_json = array();
        $child_json = array();
        foreach ($purchases as $purchase) {
            $child_json['id'] = $purchase->id;
            $child_json['nama'] = $purchase->nama;
            $child_json['alamat'] = $purchase->alamat;
            $child_json['barang'] = $purchase->barang;
            $child_json['bayar'] = $purchase->bayar;
            $child_json['keterangan'] = $purchase->keterangan;

            array_push($parent_json, $child_json);
        }
        return response()
            ->json($parent_json)->header('Content-Type', 'text/json');

    }

    public function getPurchaseById($id)
    {
        $purchase = PurchaseOrder::find($id);
        if ($purchase){
            $parent_json = array();
            $child_json = array();

            $child_json['id'] = $purchase->id;
            $child_json['nama'] = $purchase->nama;
            $child_json['alamat'] = $purchase->alamat;
            $child_json['barang'] = $purchase->barang;
            $child_json['bayar'] = $purchase->bayar;
            $child_json['keterangan'] = $purchase->keterangan;

            array_push($parent_json, $child_json);

            return response()
                ->json($parent_json)->header('Content-Type', 'text/json');
        }else{
            return response()
                ->json(['message' => 'Data purchase dengan id '. $id .' tidak dapat di temukan '])->header('Content-Type', 'text/json');
        }


    }

    public function deletePurchase($id){
        $purchase = PurchaseOrder::find($id);
        if ($purchase){
            $purchase->delete();
            return response()
                ->json(['message' => 'Data purchase dengan id '. $id .' telah dihapus!'])->header('Content-Type', 'text/json');
        }else{
            return response()
                ->json(['message' => 'Data purchase dengan id '. $id .' tidak dapat ditemukan!'])->header('Content-Type', 'text/json');
        }

    }
}
