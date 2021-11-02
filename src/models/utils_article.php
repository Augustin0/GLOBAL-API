<?php

namespace Article {

  class  Utils
  {
    protected $post_query;
    protected  $get_query;

    public function __construct($table)
    {
      $this->post_query = "INSERT INTO  $table(author,title,description,url,urlToImage,publishedAt,content,lang,country)  VALUES(:author, :title, :description, :url, :urlToImage, :publishedAt, :content, :lang,  :country)";
      $this->get_query = "SELECT * FROM $table";
    }
    protected function get_my_news_query($table,$author){
      return "SELECT * FROM $table WHERE author= $author";
    }
    protected function delete_by_id_query($table,$id,$author){
      return  "DELETE  FROM $table WHERE id= $id and author= $author";
    }
  }
}
