<?php

namespace App\Http\Controllers\Akademik;

use App\Http\Controllers\Controller;
use App\Services\AlatService;
use App\Services\FasilitasService;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    private $fasilitasService;
    private $alatService;
    private $table;

    public function __construct(
        FasilitasService $service,
        AlatService $alat
    ) {
        date_default_timezone_set('Asia/Singapore');
        $this->fasilitasService = $service;
        $this->alatService = $alat;
        $this->table = 'facilities';
    }

    public function index($id = null)
    {
        $data['title']  = 'Fasilitas';
        $data['datas']  = $this->fasilitasService->getData($this->table, $id);

        return view('akademik_kemahasiswaan_templates.pages.fasilitas.index', $data);
    }

    public function store(Request $request)
    {
        $this->fasilitasService->store($this->table, $request);

        return redirect('akademik_kemahasiswaan/fasilitas')->with('message', 'Berhasil disimpan');
    }

    public function store_tool(Request $request)
    {
        $this->alatService->store('tools', $request);

        return redirect('akademik_kemahasiswaan/fasilitas/detail/' . $request->fasilitas_id)->with('message', 'Berhasil disimpan');
    }

    public function show($id)
    {
        $data['title']  = 'Fasilitas';
        $data['data']   = $this->fasilitasService->getData($this->table, $id);
        $data['datas']  = $this->alatService->getDataByRequest('tools', $id);
        $kode           = substr($data['datas']->max('code'), 5);
        $data['kode']   = (int)$kode + 1;

        return view('akademik_kemahasiswaan_templates.pages.fasilitas.detail', $data);
    }

    public function edit($id)
    {
        $data['title']  = 'Fasilitas';
        $data['data']   = $this->fasilitasService->getData($this->table, $id);
        $data['status'] = ['Tersedia', 'Sibuk'];

        return view('akademik_kemahasiswaan_templates.pages.fasilitas.edit', $data);
    }

    public function edit_tool($id)
    {
        $data['title']  = 'Alat-alat';
        $data['data']    = $this->alatService->getData('tools', $id);

        return view('akademik_kemahasiswaan_templates.pages.fasilitas.edit_alat', $data);
    }

    public function update(Request $request, $id)
    {
        $this->fasilitasService->update($this->table, $request, $id);

        return redirect('akademik_kemahasiswaan/fasilitas')->with('message', 'Berhasil diperbaharui');
    }

    public function update_tool(Request $request, $id)
    {
        $this->alatService->update('tools', $request, $id);

        return redirect('akademik_kemahasiswaan/fasilitas/detail/' . $request->fasilitas_id)->with('message', 'Berhasil diperbaharui');
    }

    public function delete($id)
    {
        $this->fasilitasService->delete($this->table, $id);

        return redirect('akademik_kemahasiswaan/organisasi-mahasiswa')->with('message', 'Has been deleted permanent');
    }

    public function softDelete($id)
    {
        $this->fasilitasService->softDelete($this->table, $id);
        return redirect('akademik_kemahasiswaan/fasilitas')->with('message', 'Berhasil dihapus');
    }

    public function trashed($id = null)
    {
        $data['title'] = 'Fasilitas';
        $data['ukm'] = $this->fasilitasService->getTrashed($this->table, $id);

        return view('akademik_kemahasiswaan/organisasi-mahasiswa', $data);
    }

    public function restore($id)
    {
        $this->fasilitasService->restore($this->table, $id);
        return redirect('akademik_kemahasiswaan/organisasi-mahasiswa/trashed')->with('message', 'Has been deleted');
    }
}
