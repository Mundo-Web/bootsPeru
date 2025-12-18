<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Http\Classes\dxResponse;
use App\Models\dxDataGrid;
use App\Models\Status;
use App\Models\User;
use SoDe\Extend\JSON;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Auth;
use SoDe\Extend\Response;
use Throwable;

class SaleController extends Controller
{

    public function index(Request $request)
    {
        $statuses = Status::where('status', true)->get();
        return view('pages.pedidos.index')
            ->with('statuses', $statuses);
    }

    public function paginate(Request $request): HttpResponse|ResponseFactory
    {
        $estado = $request->estado ?? 0;
        $response =  new dxResponse();
        try {
            $instance = Sale::select()->with('status');

            if ($estado !== null && $estado != 0) {
                $instance->where('status_id', $estado);
            }

            if ($request->group != null) {
                [$grouping] = $request->group;
                $selector = \str_replace('.', '__', $grouping['selector']);
                $instance = Sale::select([
                    "{$selector} AS key"
                ])->with('status')
                    ->groupBy($selector);
            }

            if (!Auth::user()->hasRole('Admin') || $request->data == 'mine') {
                $instance->where('email', Auth::user()->email);
            }

            if ($request->filter) {
                $instance->where(function ($query) use ($request) {
                    dxDataGrid::filter($query, $request->filter ?? []);
                });
            }

            if ($request->sort != null) {
                foreach ($request->sort as $sorting) {
                    $selector = \str_replace('.', '__', $sorting['selector']);
                    $instance->orderBy(
                        $selector,
                        $sorting['desc'] ? 'DESC' : 'ASC'
                    );
                }
            } else {
                $instance->orderBy('id', 'DESC');
            }

            $totalCount = 0;
            if ($request->requireTotalCount) {
                $totalCount = $instance->count('*');
            }

            $jpas = [];
            if (!$request->ignoreData) {
                $jpas = $request->isLoadingAll
                    ? $instance->get()
                    : $instance
                    ->skip($request->skip ?? 0)
                    ->take($request->take ?? 10)
                    ->get();
            }

            $results = [];

            foreach ($jpas as $jpa) {
                $result = JSON::unflatten($jpa->toArray(), '__');
                $results[] = $result;
            }

            $response->status = 200;
            $response->message = 'Operación correcta';
            $response->data = $results;
            $response->totalCount = $totalCount;
        } catch (\Throwable $th) {
            $response->status = 400;
            $response->message = $th->getMessage() . " " . $th->getFile() . ' Ln.' . $th->getLine();
        } finally {
            return response(
                $response->toArray(),
                $response->status
            );
        }
    }

    public function confirmation(Request $request): HttpResponse|ResponseFactory
    {
        $response =  new Response();
        try {
            $sale = Sale::findOrfail($request->id);

            if ($request->field == 'client') {
                $sale->confirmation_client = true;
                $sale->confirmation_user = true;
            } else if ($request->field == 'user') {
                $sale->confirmation_user = true;
                if (!User::where('email', $sale->email)->exists()) {
                    $sale->confirmation_client = true;
                }
            }

            $sale->save();

            $response->status = 200;
            $response->message = 'Operación correcta';
        } catch (Throwable $th) {
            $response->status = 400;
            $response->message = $th->getMessage();
        } finally {
            return response(
                $response->toArray(),
                $response->status
            );
        }
    }

    public function status(Request $request): HttpResponse|ResponseFactory
    {
        $response =  new Response();
        try {
            $sale = Sale::findOrfail($request->id);

            $sale->status_id = $request->status_id;
            $sale->save();

            $response->status = 200;
            $response->message = 'Operación correcta';
        } catch (Throwable $th) {
            $response->status = 400;
            $response->message = $th->getMessage();
        } finally {
            return response(
                $response->toArray(),
                $response->status
            );
        }
    }
}
