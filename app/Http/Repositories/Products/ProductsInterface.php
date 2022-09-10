<?php
namespace App\Http\Repositories\Products;
interface ProductsInterface
{
    public function getAllProducts();

    public function getProductById($id);

    public function createOrUpdate( $id = null, $collection = [] );

    public function deleteProduct($id);

}
