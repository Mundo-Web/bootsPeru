<?php

namespace App\Providers;

use App\Http\Controllers\IndexController;
use App\Models\Blog;
use App\Models\Category;
use App\Models\General;
use App\Models\LibroReclamaciones;
use App\Models\Message;
use App\Models\PoliticaDatos;
use App\Models\PolyticsCondition;
use App\Models\Products;
use App\Models\Sale;
use App\Models\Tag;
use App\Models\TermsAndCondition;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Pagination\Paginator as PaginationPaginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('auth.register', function ($view) {
            $termsAndCondicitions = TermsAndCondition::first();
            $politicas = PoliticaDatos::first();
            $view->with(['politicas'=> $politicas , 'terminos' => $termsAndCondicitions]);
        });

        View::composer('components.public.footer', function ($view) {


            // Obtener los datos del footer
            $datosgenerales = General::first(); // Suponiendo que tienes un modelo Footer y un método footerData() en él
            // Pasar los datos a la vista

            //jalar datos de un controlador 
            $politicDev = PolyticsCondition::first();
            $termsAndCondicitions = TermsAndCondition::first();
            $politicaDatos = PoliticaDatos::first();

            $view->with(['datosgenerales' => $datosgenerales, 'politicas' => $politicDev, 'terminos' => $termsAndCondicitions , 'politicaDatos' => $politicaDatos]);
        });

        View::composer('components.public.header', function ($view) {
            
            $datosgenerales = General::all();
            $blog = Blog::where('status', '=', 1)->where('visible', '=', 1)->count(); // Suponiendo que tienes un modelo Footer y un método footerData() en él
            $categoriasMenu = Category::where('visible', '=', 1)->where('is_menu', 1)->get();

            $categorias = Category::with(['subcategories' => function ($query) {
                $query->whereHas('products');
            }])->get();


            $tags = Tag::where('is_menu', 1)
                ->whereHas('productos')
                ->get();

            $offerExists = Products::where('status', true)
                ->where('descuento', '>', 0)
                ->exists();

            // Pasar los datos a la vista
            $view->with(['datosgenerales' => $datosgenerales, 'blog' => $blog,  
            'categoriasMenu' => $categoriasMenu, 'tags' => $tags, 'offerExists' => $offerExists , 'categorias'=> $categorias]);
        });

        View::composer('components.app.sidebar', function ($view) {
            // Obtener los datos del footer
            $salesCount = Sale::where('status_id', 3)->count();
            $mensajes = Message::where('is_read', '!=', 1)->where('status', '!=', 0)->count(); // Suponiendo que tienes un modelo Footer y un método footerData() en él
            $reclamo =  LibroReclamaciones::where('is_read', '!=', 1)->where('status', '!=', 0)->count();
            // Pasar los datos a la vista
            $view
                ->with('salesCount', $salesCount)
                ->with('mensajes', $mensajes)
                ->with('reclamo', $reclamo);
        });

        PaginationPaginator::useTailwind();
    }
}
