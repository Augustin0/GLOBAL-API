<?php
namespace Article{

    use Exception;
    use jcobhams\NewsApi\NewsApi as NewsApi;
   use PDO;
    use Stringable;

class Article extends Utils{
     protected            $conn;
     protected $table="articles";
     protected              $key;
     protected            $utils;

     //
     
     public                  $id;
     public              $author;
     public               $title;
     public         $description;
     public                 $url;
     public          $urlToImage;
     public         $publishedAt;
     public             $content;
      //params
      public            $q="Java";
      public             $at=null;
      public             $to=null;
      public           $lang="en";
      public            $ctr="us";
      public               $token;


     public function __construct($conn,$key)
     {
        if(!$this->conn)                    $this->conn=$conn;
        if(!$this->key)                       $this->key=$key;
        if(!$this->utils) $this->utils=new Utils($this->table);

     }


     protected function fetch():Array
     {

      $newsapi = new NewsApi($this->key);
      $data=null;
      try{
      $data=$newsapi->getTopHeadLines($this->q,null, $this->ctr, null,null, null);
      if(count($data->articles)==0){
         $data=$newsapi-> getEverything($this->q, null,  null, null,   $this->at, $this->to, $this->lang, null, null,null);
      }
       }catch(Exception $err){
         return [];
       }finally{
          
          if($data)return [$data->articles];
       }
     
     }
     

     //get all data from sqldb and https 
     public function get()
     {
        $local_data=array();
        $fetch_data=$this->fetch();
        $prepare=$this->conn->prepare($this->utils->get_query);
        if($prepare)
        {
          $prepare->execute();
          while ($row=$prepare->fetch(PDO::FETCH_ASSOC)) {
             extract($row);
             $data=array(
                 "id"              =>$id,
                 "author"           =>$author,
                 "title"             =>$title,
                 "description" =>$description,
                 "url"                  =>$url,
                 "urlToImage"    =>$urlToImage,
                 "publishedAt"   =>$publishedAt,
                 "content"           =>$content,
             );
             array_push($local_data,$data);
          }
          if($fetch_data)$local_data +=$fetch_data[0];
          return  $local_data;
        }

     }

     


     public function post()//just authors
     {
        //validate and decode token jwt and get data
       $prepare=$this->conn->prepare($this->utils->post_query); 

       if(!$this->author|!$this->title|!$this->description|!$this->url|!$this->urlToImage|!$this->publishedAt|!$this->content|!$this->lang|!$this->ctr)return -3;
      
       $this->url                =htmlspecialchars(strip_tags($this->url));
       $this->lang              =htmlspecialchars(strip_tags($this->lang));
       $this->title            =htmlspecialchars(strip_tags($this->title));
       $this->author          =htmlspecialchars(strip_tags($this->author));
       $this->content         =htmlspecialchars(strip_tags($this->content));
       $this->country             =htmlspecialchars(strip_tags($this->ctr));
       $this->urlToImage   =htmlspecialchars(strip_tags($this->urlToImage));
       $this->description =htmlspecialchars(strip_tags($this->description));
       $this->publishedAt =htmlspecialchars(strip_tags($this->publishedAt));

       if($prepare){
         $prepare->                            bindParam(":url",$this->url);
         $prepare->                          bindParam(":lang",$this->lang);
         $prepare->                         bindParam(":title",$this->title);
         $prepare->                       bindParam(":author",$this->author);
         $prepare->                         bindParam(":country",$this->ctr);
         $prepare->                     bindParam(":content",$this->content);
         $prepare->               bindParam(":urlToImage",$this->urlToImage);
         $prepare->              bindParam(":description",$this->description);
         $prepare->             bindParam(":publishedAt",$this->publishedAt);
         
         if($prepare->execute())return 1;
         else return -1;

       } else return -2;

     }


     public function getMynews(){
        if(!$this->author)return [];
        $my_news=[];
         $prepare=$this->conn->prepare($this->utils->get_my_news_query);  
         if($prepare){
             $prepare->bindParam(":author",$this->author);
             if($prepare->execute()){
               while ($row=$prepare->fetch(PDO::FETCH_ASSOC)) {
                  extract($row);
                  $data=array(
                      "id"              =>$id,
                      "author"           =>$author,
                      "title"             =>$title,
                      "description" =>$description,
                      "url"                  =>$url,
                      "urlToImage"    =>$urlToImage,
                      "publishedAt"   =>$publishedAt,
                      "content"           =>$content,
                  );
                  array_push($my_news,$data);
               }
               return $my_news;
             } else return[]; 
         }else return [] ;

     }
     
     public function put()
     {

     }
     
     public function delete()
     {

     }
        
}

}

?>