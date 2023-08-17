<?php

namespace App\Repositories;

use App\Services\AlatService;
use Darryldecode\Cart\Cart;
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

       $cart = \Cart::add([
            'id' => $tool->id,
            'name' => $tool->name,
            'price' => 0,
            'quantity' => $request->qty,
        ]);
    }
}
