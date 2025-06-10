<?php

namespace App\Http\Controllers;

use App\Models\Popup;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;

class PopupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $popups = Popup::all();
        return view('pages.popup.index', compact('popups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $popups = new Popup();
        return view('pages.popup.save', compact('popups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        $popup = Popup::find($request->id);
        if (!$popup) {
            $data['status'] = true;
            $data['image'] = $this->saveImg($request, 'image');
            $popup = Popup::create($data);
        } else {
            if(!$request->hasFile('image')) {
                $data['image'] = $popup->image;
            } else {
                $data['image'] = $this->saveImg($request, 'image');
            }
            $popup->update($data);
        }

        return redirect()->route('popup.index')->with('success', 'Popup creado correctamente');
    }

    private function saveImg(Request $request, $field){
        if(isset($request->id)){
            $producto = Popup::find($request->id);
            $ruta = $producto->$field;
    
            //borrar imagen
            if (!empty($ruta) && file_exists($ruta)) {
              // Borrar imagen
              unlink($ruta);
            }
          }
          if ($request->hasFile($field)) {
            $file = $request->file($field);
            $route = 'storage/images/imagen/';
            // $route = "storage/images/productos/$request->categoria_id/";
            $nombreImagen = Str::random(10) . '_' . $file->getClientOriginalName();
            // $nombreImagen = $request->sku.'.png';
            $manager = new ImageManager(new Driver());
            $img =  $manager->read($file);
            // $img->coverDown(340, 340, 'center');
      
            if (!file_exists($route)) {
              mkdir($route, 0777, true);
            }
      
            // $img->save($route . $nombreImagen);
            $img->save($route . $nombreImagen);
            return $route . $nombreImagen;
          }
          return 'images\img\noimagen.jpg';
    }

    /**
     * Display the specified resource.
     */
    public function show(Popup $popup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Popup $popups, string $id)
    {
        //
        $popups = Popup::find($id);
      
        
        return view('pages.popup.save', compact('popups'));
    }

    public function deleteBanner(Request $request)
    {
        $popups = Popup::find($request->id);
        $popups->delete();
        return response()->json(['success' => 'Banner eliminado correctamente']);
    }
    public function updateVisible(Request $request)
  {
    $id = $request->id;
    $field = $request->field;
    $status = $request->status;

    // Verificar si el producto existe
    $popups = Popup::find($id);

    if (!$popups) {
      return response()->json(['message' => 'Producto no encontrado'], 404);
    }

    // Actualizar el campo dinámicamente
    $popups->update([
      $field => $status
    ]);
    return response()->json(['message' => 'registro actualizado']);
  }
    
    
}
