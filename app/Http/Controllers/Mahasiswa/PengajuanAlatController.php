<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Services\AlatService;
use App\Services\MahasiswaService;
use App\Services\PengajuanAlatService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function subtractCart($id){
        \Cart::update($id, array(
            'quantity' => -1,
          ));
        return redirect ('mahasiswa/pengajuan/alat/detail_cart');
    }

    public function addedCart($id){
        \Cart::update($id, array(
            'quantity' => 1,
        ));
        return redirect('mahasiswa/pengajuan/alat/detail_cart');
    }

    public function deletedCart($id){
        \Cart::remove($id);
        // dd($id);
        return redirect('mahasiswa/pengajuan/alat/detail_cart');
    }
}
