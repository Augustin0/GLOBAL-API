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
      $this->post_query = "INSERT INTO  $table(author,title,description,url,urlToImage,publishedAt,content,lang,country)  VALUES(:author,  :title,  :description,  :url,  :urlToImage,  :publishedAt, :content,    :lang,   :country)";
      $this->get_query = "SELECT * FROM $table";
      $this->get_my_news_query = "SELECT * FROM $table WHERE author= ?";
      $this->delete_by_id_query = "DELETE  FROM $table WHERE id= ? and author= ?";
    }
  }
}
