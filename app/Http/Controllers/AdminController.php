<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use App\Product;

class AdminController extends Controller
{
    public function index(){
      return View::make('panel');
    }

    public function getProducts(){
      return Product::all();
    }

    public function saveProduct()
    {

      $v = \Validator::make(Input::all(), [
          'name_prod'       => 'required|string',
          'category_prod'   => 'required|string',
          'quantity_prod'   => 'required|string',
          'date_prod'   => 'required|string',
          'description_prod'   => 'required|string',
          'price_prod'   => 'required|string',
      ]);

      if ($v->fails())
        return \Response::json(array('status' => 'error', 'messages' => $v->errors()));

      $data = Input::all();
      $product = new Product;

      $product->prod_name         = $data['name_prod'];
      $product->prod_category     = $data['category_prod'];
      $product->prod_description  = $data['description_prod'];
      $product->prod_quantity     = $data['quantity_prod'];
      $product->prod_date_start  = $data['date_prod'];
      $product->prod_price       = $data['price_prod'];
      $product->prod_name_image  = '';

      if($product->save())
        return \Response::json(array('status' => 'success', 'message' => 'Producto agregado'));
    }
}
