<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\DetalleOrden;
use App\Models\General;

use App\Models\Ordenes;
use App\Models\Person;
use App\Models\PrecioEnvio;
use App\Models\Price;
use App\Models\Products;
use App\Models\User;
use Culqi\Culqi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SoDe\Extend\JSON;
use SoDe\Extend\Math;
use SoDe\Extend\Response;
use SoDe\Extend\Crypto;
use SoDe\Extend\File;

class PaymentController extends Controller
{
  public function culqi(Request $request)
  {
    $body = $request->all();
    $response = new Response();
    $culqi = new Culqi(['api_key' => env('CULQI_PRIVATE_KEY')]);

    $sale = new Ordenes();
    $this->processSale($body, $sale, $response);
    dump($sale);

    $config = $this->getCulqiConfig($body, $sale);


    try {
      $charge = $culqi->Charges->create($config);

      if (gettype($charge) == 'string') {
        $res = JSON::parse($charge);
        throw new Exception($res['user_message']);
      }

      $response->status = 200;
      $response->message = "Cargo creado correctamente";
      $response->data = [
        'charge' => $charge,
        'reference_code' => $charge?->reference_code ?? null,
        'amount' => $sale->monto,
      ];

      $this->finalizeSale($sale, $charge?->reference_code ?? null);
    } catch (\Throwable $th) {
      dump($th);
      $response->status = 400;
      $response->message = $th->getMessage();
      $this->handleSaleError($sale);
    } finally {
      $sale->save();
      return response($response->toArray(), $response->status);
    }
  }

  public function pagarConTransferencia(Request $request)
  {
    $body = $request->all();
    $response = new Response();

    $sale = new Ordenes();
    $sale->codigo_orden = random_int(10000, 99999);
    $sale->tipo_tarjeta = 'transferencia';
    $sale->numero_tarjeta = '';

    $this->processSale($body, $sale, $response);

    $response->status = 200;
    $response->message = "Cargo creado correctamente";
    $response->data = [
      'reference_code' => $sale->codigo_orden ?? null,
      'amount' => $sale->monto,
    ];

    $this->finalizeSale($sale, $sale->codigo_orden ?? null);

    try {
      $sale->save();
      return response($response->toArray(), $response->status);
    } catch (\Throwable $th) {
      $response->status = 400;
      $response->message = $th->getMessage();
      $this->handleSaleError($sale);
      return response($response->toArray(), $response->status);
    }
  }

  private function processSale($body, $sale, &$response)
  {
    

    $products = $body['cart'];


    $productsJpa = Products::select(['id', 'imagen', 'producto', 'precio', 'descuento'])
      ->whereIn('id', array_map(fn($x) => $x['id'], $products))
      ->get();

    $restPoints = Auth::check() ? Auth::user()->points : 0;
    $totalCost = 0;
    $points2discount = 0;

    $details = [];

    foreach ($productsJpa as $productJpa) {
      $key = array_search($productJpa->id, array_column($body['cart'], 'id'));
      $finalQuantity = $body['cart'][$key]['quantity'];
      $finalPrice = $productJpa->descuento > 0 ? $productJpa->descuento :  $productJpa->precio;

      $totalCost += $finalPrice;

      $details[] = [
        'producto_id' => $productJpa->id,
        'name' => $productJpa->producto,
         'imagen' => $body['cart'][$key]['imagen'] ?? '',
        'cantidad' => $body['cart'][$key]['quantity'],
        'precio' => $finalPrice,
        'price_used' => $finalPrice * $finalQuantity,


      ];
    }
    $precioEnvio = 0 ;
    $addresFull = ""; 
    if(isset($body['address']['id'])){
      $precioEnvioJpa = Price::where('id', $body['address']['id'])->first();
      $precioEnvio = $precioEnvioJpa->price;

      $addresFull = $body['address']['street'] . ', ' . $body['address']['city'] . ' ' . $body['address']['number'] . ' - ' . $body['address']['description'];
    }

    


    $descuento = 0;


    $tipoComprobante = 'N/A';
    if ($body['tipo_comprobante'] == 'factura') {
      $tipoComprobante = 'RUC';
    } else if ($body['tipo_comprobante'] == 'boleta') {
      $tipoComprobante = 'DNI';
    }


    $sale->usuario_id = Auth::user()?->id ?? null;
    $sale->status_id = 1;
    $sale->codigo_orden = '00000000';

    $sale->address_full = $addresFull;

    $sale->address_data = JSON::stringify($body['address']);
    $sale->precio_envio = $precioEnvio;
    $sale->monto = $totalCost - $descuento;
    $sale->billing_type = $tipoComprobante;
    $sale->billing_document = $tipoComprobante;
    $sale->billing_name = $body['contact']['name'] . ' ' . $body['contact']['lastname'];
    $sale->billing_address = $body['contact']['address'] ?? '';
    $sale->billing_email = $body['contact']['email'];
    $sale->consumer_phone = $body['contact']['phone'];
    




    if (isset($body['dedication']['image'])) {
      try {
        $sale->dedication_image = $this->saveImage($body['dedication']['image']);
      } catch (\Throwable $th) {
        $sale->dedication_image = null;
      }
    }

    $sale->save();

    foreach ($details as $detail) {
      DetalleOrden::create([
        ...$detail,
        'orden_id' => $sale->id
      ]);
    }

    
  }

  private function getCulqiConfig($body, $sale)
  {
    return [
      "amount" => round(($sale->monto + $sale->precio_envio) * 100),
      "capture" => true,
      "currency_code" => "PEN",
      "description" => "Compra en " . env('APP_NAME'),
      "email" => $body['culqi']['email'] ?? $body['billing']['email'],
      "installments" => 0,
      "antifraud_details" => [
        "address" => $body['address']['street'] ?? 'Av. Petit thouars 5356 C.C. Compupalace, 3er Piso' ,
        "address_city" => $body['address']['district'] ?? 'Lima - Perú',
        "country_code" => "PE",
        "first_name" => $body['contact']['name'],
        "last_name" => $body['contact']['lastname'],
        "phone_number" => $body['contact']['phone'],
      ],
      "source_id" => $body['culqi']['id']
    ];
  }

  private function finalizeSale($sale, $referenceCode)
  {
    $sale->status_id = 3;
    $sale->codigo_orden = $referenceCode;
  }

  private function handleSaleError($sale)
  {
    if (!$sale->codigo_orden) {
      $sale->codigo_orden = '000000000000';
    }
    $sale->status_id = 2;
  }

  public function saveImage($file)
  {
    try {
      [$first, $code] = explode(';base64,', $file);
      $imageData = base64_decode($code);
      $routeImg = 'storage/images/dedication/';
      $ext = File::getExtention(str_replace("data:", '', $first));
      $nombreImagen = Crypto::randomUUID() . '.' . $ext;
      if (!file_exists($routeImg)) {
        mkdir($routeImg, 0777, true);
      }
      file_put_contents($routeImg . $nombreImagen, $imageData);
      return $routeImg . $nombreImagen;
    } catch (\Throwable $th) {
      return null;
    }
  }
}
