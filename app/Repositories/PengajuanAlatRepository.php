<?php

namespace App\Repositories;

use App\Models\ErrorTool;
use App\Models\Retur;
use App\Models\Tool;
use App\Services\AlatService;
use Illuminate\Support\Facades\Auth;

class PengajuanAlatRepository extends BaseRepository
{
    private $alatService;

    public function __construct(AlatService $alat)
    {
        $this->alatService = $alat;
    }

    public function getTotalCart()
    {
        $cartCollection = \Cart::getContent();
        return $cartCollection->count();
    }

    public function addToCart($request, $id)
    {
        $tool   = $this->alatService->getData('tools', $id);

        \Cart::add([
            'id' => $tool->id,
            'name' => $tool->name,
            'price' => 0,
            'quantity' => $request->qty,
            'attributes'    => [
                'image' => $tool->image,
                'stock' => $request->stok,
            ]
        ]);
    }

    public function getTotalQuantity()
    {
        $cartTotalQuantity = \Cart::getTotalQuantity();
        return $cartTotalQuantity;
    }

    public function store($table, $submission)
    {
        BaseRepository::create($table, $submission);

        $dataSubmission = BaseRepository::getData($table, $id = null)->max('id');

        $carts  = \Cart::getContent();
        foreach ($carts as $cart) {
            $detailSubmission = [
                "submissions_id"    => $dataSubmission,
                "tools_id"          => $cart->id,
                "qty"               => $cart->quantity,
                "created_by"        => Auth::user()->email,
                "updated_by"        => Auth::user()->email,
                "created_at"        => now(),
                "updated_at"        => now()
            ];

            $retur = [
                "submissions_id"    => $dataSubmission,
                "tools_id"          => $cart->id,
                "created_by"        => Auth::user()->email,
                "updated_by"        => Auth::user()->email,
                "created_at"        => now(),
                "updated_at"        => now()
            ];

            $errorTools = [
                "submissions_id"    => $dataSubmission,
                "tools_id"          => $cart->id,
                "created_by"        => Auth::user()->email,
                "updated_by"        => Auth::user()->email,
                "created_at"        => now(),
                "updated_at"        => now()
            ];

            Retur::insert($retur);
            ErrorTool::insert($errorTools);

            BaseRepository::create('detail_submissions', $detailSubmission);

            // $tool = Tool::where('id', $cart->id)->first();
            // dd($tool);

            // Tool::where('id', $cart->id)->update(['qty' => $tool->qty]);
        }
        \Cart::clear();
        return;
    }
}
