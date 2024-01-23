<?php
class Book {
    public $id = 0;
    public $title = "";
    public $description = null;
    public $imgUrl = null;
    public $pages = 0;
    public $year = 0;
    public $language ="";
    public $authorId = 0;
    public $categoryId = 0;
    public $price = 0;
    public $isbn = "";
    public $created = 0;
    public $modified = null;
    function __construct($title, $description, $imgUrl, $pages,$year,$language,$authorId,$categoryId, $price, $isbn) {
        $this->title = $title;
        $this->description = $description;
        if($description === '') {
            $this->description = null;
        }
        else {
            $this->description = $description;
        }
        if($imgUrl === '') {
            $this->imgUrl = null;
        }
        else {
            $this->imgUrl = $imgUrl;
        }
        $this->pages = $pages;
        $this->year = $year;
        $this->language = $language;
        $this->authorId = $authorId;
        $this->categoryId = $categoryId;
        $this->price = $price;
        $this->isbn = $isbn;
        $this->created = time();
    }
    
}