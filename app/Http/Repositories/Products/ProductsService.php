<?php
namespace App\Http\Repositories\Products;
use App\Models\Products;
use App\Http\Repositories\Products\ProductsInterface;
use Illuminate\Support\Facades\Hash;

class ProductsService implements ProductsInterface {

    protected $Products = null;

    public function getAllProducts()
    {
        return Products::all();
    }

    public function getProductById($id)
    {
        return Products::find($id);
    }

    public function createOrUpdate( $id = null, $collection = [] )
    {
        if(is_null($id)) {
            $Product = new Products;
            $Product->name = $collection['name'];
            $Product->sku = $collection['sku'];
            $Product->brand_id = $collection['brand_id'];
            $Product->description = $collection['description'];
            $Product->short_description = $collection['short_description'];
            $Product->category_id = $collection['category_id'];
            $Product->price = $collection['price'];
            $Product->dis_price = $collection['dis_price'];
            $Product->stock = $collection['stock'];
            return $Product->save();
        }
        $Product = Products::find($id);
        $Product->name = $collection['name'];
        $Product->sku = $collection['sku'];
        $Product->brand_id = $collection['brand_id'];
        $Product->description = $collection['description'];
        $Product->short_description = $collection['short_description'];
        $Product->category_id = $collection['category_id'];
        $Product->price = $collection['price'];
        $Product->dis_price = $collection['dis_price'];
        $Product->stock = $collection['stock'];
        return $Product->save();
    }

    public function deleteProduct($id)
    {
        return Products::find($id)->delete();
    }
}
