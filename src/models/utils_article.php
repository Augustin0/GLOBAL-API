<?php

namespace Article {

  class  Utils
  {
    protected $post_query;
    protected  $get_query;
    protected  $get_my_news_query;
    protected  $delete_by_id_query;

    public function __construct($table)
    {
      $this->post_query = "INSERT INTO  $table  SET author = :author, title= :title, description= :description, url= :url, urlToImage= :urlToImage, publishedAt= :publishedAt, content= :content,  lang = :lang, country = :country";
      $this->get_query = "SELECT * FROM $table";
      $this->get_my_news_query = "SELECT * FROM $table WHERE author= :author";
      $this->delete_by_id_query = "DELETE  FROM $table WHERE id= :id and author= :author";
    }
  }
}
