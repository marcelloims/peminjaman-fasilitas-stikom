<?php

namespace App\Repositories;

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
        $userID = Auth::user()->id;

        \Cart::add([
            'id' => $tool->id,
            'name' => $tool->name,
            'price' => 0,
            'quantity' => $request->qty,
            'attributes'    => ['image' => $tool->image]
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

            BaseRepository::create('detail_submissions', $detailSubmission);

            $tools = Tool::where('id', $cart->id)->first();

            Tool::where('id', $cart->id)->update(['qty' => $tools->qty - $cart->quantity]);
        }
        \Cart::clear();
        return;
    }
}
