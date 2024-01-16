<?php

class BookstoreView {
    public function outputJsonCollection (array $data) : void {
        if(count($data) == 0 && !$data) {
            http_response_code(400);
        }
        else {
            echo json_encode($data);
        }
    }
        public function outputJsonSingle( $data) : void {
            echo json_encode($data);
    }
}