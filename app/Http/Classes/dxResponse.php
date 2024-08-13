<?php

namespace App\Http\Classes;

use SoDe\Extend\Response;

class dxResponse extends Response
{
  public int $totalCount = 0;
  public bool $is_proveedor = false;
  public array $summary = [];
}
