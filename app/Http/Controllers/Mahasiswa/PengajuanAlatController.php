<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Submission;
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

    public function search_date(Request $request)
    {
        $dataSubmission = Submission::with('detailSubmission')
            ->where('category', 1)
            ->where('date_start', '>=', date('Y-m-d', strtotime($request->tanggal_kegiatan_mulai)) . " 08:00:00")
            ->where('date_end', '<=', date('Y-m-d', strtotime($request->tanggal_kegiatan_selesai)) . " 18:00:00")
            ->first();

        $id = [];
        if ($dataSubmission) {
            foreach ($dataSubmission->detailSubmission as $key) {
                $id[] = $key->tools_id;
            }
        }

        if (empty($request->tanggal_kegiatan_mulai) || empty($request->tanggal_kegiatan_selesai)) {
            $error = "Tanggal Mulai atau Tanggal Selesai tidak boleh kosong!";
            return redirect('mahasiswa/pengajuan/alat')->with('error', $error);
        }

        // dd($dataSubmission);

        $error = "";
        $message = "";

        if ($dataSubmission == null) {
            $startRequest   = date('Y-m-d', strtotime($request->tanggal_kegiatan_mulai));
            $endRequest     = date('Y-m-d', strtotime($request->tanggal_kegiatan_selesai));
            $dateNow        = date("Y-m-d");

            if ($startRequest > $endRequest) {
                $error = "Tanggal Salah!";
                return redirect('mahasiswa/pengajuan/alat')->with('error', $error);
            } elseif ($startRequest <= $dateNow || $endRequest <= $dateNow) {
                $error = "Tanggal sudah lewat!";
                return redirect('mahasiswa/pengajuan/alat')->with('error', $error);
            } else {
                $data['title']          = 'Pengajuan Peminjaman';
                $data['chairmans']      = $this->mahasiswaService->getChairman('users');
                $data['tools']          = $this->alatService->getToolOnly('tools');
                $data['totalCart']      = $this->pengajuanAlatService->getTotalCart();
                $data['date']           = ['start' => $startRequest, 'end' => $endRequest];

                // dd($data);
                return view('mahasiswa_templates.pages.pengajuan.alat.search', $data);
            }
        } else {

            $startRequest   = date('Y-m-d', strtotime($request->tanggal_kegiatan_mulai));
            $endRequest     = date('Y-m-d', strtotime($request->tanggal_kegiatan_selesai));
            $startExist     = substr($dataSubmission->date_start, 0, 10);
            $endExist       = substr($dataSubmission->date_end, 0, 10);
            $dateNow        = date("Y-m-d");

            // dd($startExist, $startRequest, $endExist, $endRequest);

            if (
                ($startRequest == $startExist || $endRequest == $endExist) ||
                ($startRequest < $startExist && $endRequest >= $startExist) ||
                ($startRequest >= $startExist && $startRequest == $endExist) ||
                ($startRequest >= $startExist && $endRequest <= $endExist) ||
                ($startRequest > $startExist && $endRequest < $endExist) ||
                ($startRequest > $startExist && $startRequest < $endExist)
            ) {
                // $error = "Tanggal sudah dipakai kegiatan lain! Silahkan lihat daftar peminjaman di bawah";
                // return redirect('mahasiswa/pengajuan/alat')->with('error', $error);

                $data['title']          = 'Pengajuan Peminjaman';
                $data['chairmans']      = $this->mahasiswaService->getChairman('users');
                $data['tools']          = $this->alatService->getToolOnlyById('tools', $id);
                $data['totalCart']      = $this->pengajuanAlatService->getTotalCart();
                $data['date']           = ['start' => $startRequest, 'end' => $endRequest];

                return view('mahasiswa_templates.pages.pengajuan.alat.search', $data);
            } else {
                $data['title']          = 'Pengajuan Peminjaman';
                $data['chairmans']      = $this->mahasiswaService->getChairman('users');
                $data['tools']          = $this->alatService->getToolOnly('tools');
                $data['totalCart']      = $this->pengajuanAlatService->getTotalCart();
                $data['date']           = ['start' => $startRequest, 'end' => $endRequest];

                return view('mahasiswa_templates.pages.pengajuan.alat.search', $data);
            }
        }
    }

    public function addToCart(Request $request, $id)
    {
        $this->pengajuanAlatService->addToCart($request, $id);

        $tool = $this->alatService->getData('tools', $id);

        $totalQty = $tool->qty - $request->qty;
        $updateTool = [
            'qty' => $totalQty
        ];

        // Tool::where('id', $id)->update($updateTool);

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
        // dd($request->all());
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
        return redirect('mahasiswa/pengajuan/alat');
    }

    public function clearCart()
    {
        \Cart::clear();

        return redirect('mahasiswa/pengajuan/alat');
    }
}
