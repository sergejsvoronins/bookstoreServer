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
}