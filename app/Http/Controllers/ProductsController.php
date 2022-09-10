<?php

namespace App\Http\Controllers;
use App\Models\Products;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Repositories\Products\ProductsInterface;
use Yajra\DataTables\DataTables as YajraDatatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ProductsController extends Controller
{

    public $product;
    public $dataTable;
    public function __construct(ProductsInterface $product, YajraDatatable $dataTable)
    {
        $this->product = $product;
        $this->dataTable = $dataTable;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('products.index');
    }
    public function getData(Request $request)
    {
        // $products = $this->product->getAllProducts();
        // return $products;

        $query = Products::orderBY('id',$request->get('orderby'))->select();
        return $this->dataTable->eloquent($query)
        ->escapeColumns([])
        ->addColumn('action', function ($item) {
            $action = "<td>";

            $action .= "<a data-id='". $item->id ."' class='productEditIdBtn btn btn-primary btn-sm text-white' ><i class='fa fa-edit'>Edit</i></a>&nbsp; ";
            $action .= "<a data-id='". $item->id ."'  class='productDeleteIdBtn btn btn-danger btn-sm text-white' type='button' ><i class='fa fa-trash-o'>Delete</i></a>&nbsp; ";
            $action .= "<td>";
            return $action;
        })->rawColumns(['action'])
        ->filter(function ($query) use ($request) {
            if ($request->filled('status')) {
                $query->where('status', $request->get('status'));
            }
            if ($request->filled('price_from')) {
                $query->where('price','>=',$request->get('price_from'));
            }
            if ($request->filled('price_to')) {
                $query->where('price','<=',$request->get('price_to'));
            }
        })
        ->make(true);
    }
    public function getProductData()
    {
        $products = $this->product->getAllProducts();
        return $products;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request,$id = null)
    {

        $collection=$request->all();
        $results=$this->product->createOrUpdate($id = null, $collection);
        if($results==true){
            return 1;
        }else{
            return 0;
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->product->getProductById($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request,$id)
    {
        $collection = $request;
        $results=$this->product->createOrUpdate($id, $collection);
        if($results==true){
           return 1;
       }else{
           return 0;
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $results=$this->product->deleteProduct($id);
        if($results==true){
            return 1;
        }else{
            return 0;
        }

    }
}
