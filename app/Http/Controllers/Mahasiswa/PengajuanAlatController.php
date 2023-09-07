<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Tool;
use App\Services\AlatService;
use App\Services\MahasiswaService;
use App\Services\PengajuanAlatService;
use Illuminate\Http\Request;

class PengajuanAlatController extends Controller
{
    private $pengajuanAlatService;
    private $mahasiswaService;
    private $alatService;
    private $table;

    public function __construct(
        PengajuanAlatService $service,
        MahasiswaService $mahasiswa,
        AlatService $alat
    ) {
        date_default_timezone_set('Asia/Singapore');
        $this->pengajuanAlatService = $service;
        $this->mahasiswaService = $mahasiswa;
        $this->alatService = $alat;
        $this->table = "submissions";
    }

    public function index()
    {
        $data['title']          = 'Pengajuan Peminjaman';
        $data['chairmans']      = $this->mahasiswaService->getChairman('users');
        $data['tools']          = $this->alatService->getToolOnly('tools');
        $data['totalCart']      = $this->pengajuanAlatService->getTotalCart();

        return view('mahasiswa_templates.pages.pengajuan.alat.index', $data);
    }

    public function addToCart(Request $request, $id)
    {
        $this->pengajuanAlatService->addToCart($request, $id);

        $tool = $this->alatService->getData('tools', $id);

        $totalQty = $tool->qty - $request->qty;
        $updateTool = [
            'qty' => $totalQty
        ];

        Tool::where('id', $id)->update($updateTool);

        return redirect('mahasiswa/pengajuan/alat')->with('message', 'Berhasil ditambahkan');
    }

    public function detailCart()
    {
        $data['title']      = 'Peminjaman';
        $data['carts']      = \Cart::getContent();
        $data['chairmans']  = $this->mahasiswaService->getChairman('users');
        $data['totalQty']   = $this->pengajuanAlatService->getTotalQuantity();

        return view('mahasiswa_templates.pages.pengajuan.alat.detail_cart', $data)->with('message', 'Berhasil ditambahkan');
    }

    public function store(Request $request)
    {
        $data['alat']   = $this->pengajuanAlatService->store($this->table, $request);

        return redirect('mahasiswa/pengajuan/alat')->with('message', "Berhasil disimpan!");
    }

    public function subtractCart(Request $request, $id)
    {
        $cartItem           = \Cart::get($id);
        $cartQuantity       = $cartItem->quantity - 1;
        $attributesStock    = $cartItem->attributes->stock - $cartQuantity;
        \Cart::update($id, array(
            'quantity' => -1,
            'attributues' => array('stock' => $attributesStock)
        ));

        $updateTool = ['qty' => $request->stok - $cartItem->quantity];

        Tool::where('id', $id)->update($updateTool);

        return redirect('mahasiswa/pengajuan/alat/detailCart');
    }

    public function addedCart(Request $request, $id)
    {
        $cartItem           = \Cart::get($id);
        $cartQuantity       = $cartItem->quantity + 1;
        $attributesStock    = $cartItem->attributes->stock - $cartQuantity;
        \Cart::update($id, array(
            'quantity'      => +1,
            'attributues'   => array('stock' => $attributesStock)
        ));

        $updateTool = ['qty' => $request->stok - $cartItem->quantity];

        Tool::where('id', $id)->update($updateTool);

        return redirect('mahasiswa/pengajuan/alat/detailCart');
    }

    public function deletedCart(Request $request, $id)
    {
        \Cart::remove($id);

        $updateTool = [
            'qty' => $request->stok
        ];

        Tool::where('id', $id)->update($updateTool);
        return redirect('mahasiswa/pengajuan/alat/detailCart');
    }

    public function clearCart()
    {
        \Cart::clear();

        return redirect('mahasiswa/pengajuan/alat');
    }
}
