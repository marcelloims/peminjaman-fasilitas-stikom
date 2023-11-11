<?php

namespace App\Http\Controllers\Sarpras;

use App\Http\Controllers\Controller;
use App\Models\Tool;
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

        return view('sarpras_templates.pages.fasilitas.index', $data);
    }

    public function store_tool(Request $request)
    {
        $this->alatService->store('tools', $request);

        return redirect('sarpras/fasilitas/detail/' . $request->fasilitas_id)->with('message', 'Berhasil disimpan');
    }

    public function show($id)
    {
        $data['tools']      = $this->alatService->getDataByRequest('tools', $id);
        $data['title']      = 'Fasilitas';
        $data['fasilitas']  = $this->fasilitasService->getData($this->table, $id);
        $tools              = Tool::where('code', 'like', '%#BRG-AL-%')->get();
        $kode               = substr($tools->max('code'), 8);
        $data['kode']       = (int)$kode + 1;

        return view('sarpras_templates.pages.fasilitas.detail', $data);
    }

    public function edit_tool($id)
    {
        $data['title']  = 'Alat-alat';
        $data['data']    = $this->alatService->getData('tools', $id);

        return view('sarpras_templates.pages.fasilitas.edit_alat', $data);
    }

    public function update_tool(Request $request, $id)
    {
        $this->alatService->update('tools', $request, $id);

        return redirect('sarpras/fasilitas/detail/' . $request->fasilitas_id)->with('message', 'Berhasil diperbaharui');
    }

    public function softDelete($id)
    {
        $tool = Tool::where('id', $id)->first();
        $this->fasilitasService->softDelete('tools', $id);

        return redirect('sarpras/fasilitas/detail/' . $tool->facilities_id)->with('message', 'Berhasil dihapus');
    }
}
