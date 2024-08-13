<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\OfferDetail;
use App\Models\Products;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Exception;

class OfferController extends BasicController
{
    public $model = Offer::class;

    /**
     * Display a listing of the resource.
     */
    public function reactView()
    {
        $offers = Offer::with('products')
            ->where('status', true)
            ->get();

        return Inertia::render('Admin/Offers', [
            'offers' => $offers,
        ])->rootView('admin');
    }

    public function all(Request $request) {
        return Offer::with('products')
        ->where('status', true)
        ->get();
    }

    public function get(Request $request, string $id) {
        $offer = Offer::with('products')->where('id', $id)->first();
        return $offer;
    }

    public function beforeSave(Request $request)
    {
        $products = $request->products;
        if (count($products) <= 0) throw new Exception('Seleccione al menos un producto en el combo');
        if (!$request->parent_id) throw new Exception('Marque un producto como principal');
        return $request->all();
    }

    public function afterSave(Request $request, object $jpa)
    {
        $jpa->products()->detach();
        $products = $request->products;
        foreach ($products as $product) {
            OfferDetail::create([
                'offer_id' => $jpa->id,
                'product_id' => $product,
                'isParent' => $request->parent_id == $product,
            ]);
        }
    }
}
