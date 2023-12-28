<?php
class Book {
    public $id = 0;
    public $title = "";
    public $description = null;
    public $pages = null;
    public $year = 0;
    public $language ="";
    public $authorId = 0;
    public $categoryId = 0;
    public $price = 0;
    public $isbn = 0;
    public $created = 0;
    public $modified = null;
    function __construct($title, $description,$pages,$year,$language,$authorId,$categoryId, $price, $isbn) {
        $this->title = $title;
        $this->description = $description;
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