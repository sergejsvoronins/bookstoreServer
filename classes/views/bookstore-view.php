<?php

class BookstoreView {
    public function outputJsonCollection (array $data) : void {
        if(count($data) == 0) {
            http_response_code(400);
        }
        else {
            echo json_encode($data);
        }
    }
        public function outputJsonSingle( $data) : void {
            // if($data instanceof Book) {
            //     $json = [
            //         "id" => $data->id,
            //         "last_name" => $data->last_name,
            //         "first_name" => $data->first_name,
            //         "epost" => $data->epost,
            //         "mobile" => $data->mobile,
            //         "creating_date" => $data->creating_date,
            //         "products_count" => $data->getProductsCount(),
            //         "sold_products_count" => $data->getSoldProductsCount(),
            //         "total_selling_price" =>$data->getTotalSellingPrice(),
            //         "products_list" => $data->getProductsList()
            //     ];
            // }
            // else if($data instanceof Product) {
            //     $json = [
            //         "id" => $data->id,
            //         "name" => $data->name,
            //         "size" => $data->getSize(),
            //         "category" => $data->getCategory(),
            //         "price" => $data->price,
            //         "seller_ID" => $data->getSellerId(),
            //         "seller_name" => $data->getSellerName(),
            //         "creating_date" => $data->creating_date,
            //         "selling_date" => $data->selling_date,
            //     ];
            // }
            // else {
            //     http_response_code(400);
            //     $json = [
            //         "message" => "Bad Request"
            //     ];
            // }
            echo json_encode($data);
            // echo json_encode($json);
    }
}