<?php
 class edit extends model {

        function newProduct(){
            $filepath = $this->pictureLink($_FILES["uploadimage"]);
            $this->model->query('INSERT INTO `products` (name, price, description, manufacture, color, size, material ,stock, tags, images,views,upVote,alt) 
VALUES (?,?,?,?,?,?,?,?,?,?,0,0,?)' ,
                array(
                    url::post("product_name"),
                    url::post("product_price"),
                    url::post("product_description"),
                    url::post("product_manufacture"),
                    url::post("product_color"),
                    url::post("product_size"),
                    url::post("product_category"),
                    url::post("product_stock"),
                    url::post("product_tags"),
                    $filepath,
                    url::post("alt_tag")
                ));
        }

        function updateMovie(){

            if (file_exists($_FILES["uploadimage"]["name"] || is_uploaded_file($_FILES["uploadimage"]["tmp_name"]))) {
                $filepath = $this->pictureLink($_FILES["uploadimage"]);
            }
            else{
                $filepath = url::post("spareImage");
            }

            $msg=$this->model->query("UPDATE `movie` SET `movie_title`=?, `movie_desc`=?, `img`=?, `director`=?, `year`=?, `youtube`=?, `price`=?, `tags`=? WHERE `movie_id`=?",
                array(url::post("movie_title"),
                    url::post("movie_desc"),
                    $filepath,
                    url::post("movie_dir"),
                    url::post("movie_year"),
                    url::post("movie_youtube"),
                    url::post("movie_price"),
                    url::post("movie_tags"),
                    url::post("movie_id")
                ));

              message::note('success');
            url::reload();
        }

        function deleteMovie($id){

        //    $var = $this->model->connect();

             $msg = $this->model->query("DELETE FROM `movie` WHERE `movie_id`=?",
                 array($id));


        }


        function delete_news($page) {
            $this->model->query("DELETE FROM `newspage` WHERE `Page_ID`=?",array($page));
            url::reload();
        }
        function addNews(){
            $header = url::post("add_news_header");
            $text = url::post("add_news_text");
            $alt = url::post("news_alt_tag");

            $filepath = $this->pictureLink($_FILES["uploadimage"]);
            $this->model->query("INSERT INTO `newspage` 
(`Page_ID`, `Image`, `Description`, `DATE`, `Header`, `alt`) 
VALUES (NULL, ?,?,NOW(),?,?)",array($filepath,$text,$header,$alt));

        }

     function Add_Movie(){
         $movie_title = url::post("movie_title");
         $movie_desc = url::post("movie_desc");
         $director = url::post("movie_dir");
         $year = url::post("movie_year");
         $alt = url::post("movie_alt_tag");
         $youtube = url::post("youtube");
         $price = url::post("movie_price");
         $tags = url::post("movie_tags");


         $filepath = $this->pictureLink($_FILES["uploadimage"]);
         $this->model->query("INSERT INTO `movie` 
(`movie_id`, `movie_title`, `movie_desc`, `img`, `director`, `year`, `date`, `alt`, `youtube`, `price`, `tags`) 
VALUES (NULL,?,?,?,?,?,NOW(),?,?,?,?)",array($movie_title,$movie_desc,$filepath,$director,$year,$alt,$youtube,$price,$tags));}







        private function pictureLink($file)
        {
            $filepath = "";
            if (file_exists("/Movie_assign/assets/" .$file["name"]) || is_uploaded_file($file["tmp_name"])) {


                if ($file['size'] > 0 &&
                    (($file["type"] == "image/gif") ||
                        ($file["type"] == "image/jpeg") ||
                        ($file["type"] == "image/pjpeg") ||
                        ($file["type"] == "image/png") &&
                        ($file["size"] < 2097152))
                ) {

                    $filepath = 'web_images/' . $file["name"];
                    move_uploaded_file($file["tmp_name"], $GLOBALS['config']['path']['basePath'].'assets/' . $filepath );

                }
                if ($file["error"] > 0) {
                    echo "Return Code: " . $file["error"] . "<br />";
                }
            }
            else {
                $filepath = 'web_images/' . $file["name"];
            }
            return $filepath;
        }

     // UPDATE COMPANY DESCRIPTION
     function company_desc(){
         if (file_exists($_FILES["uploadimage"]["name"] || is_uploaded_file($_FILES["uploadimage"]["tmp_name"]))) {
         $filepath = $this->pictureLink($_FILES["uploadimage"]);
         }
         else{
             $filepath = url::post("spareImage");
         }
        $msg = $this->model->query("UPDATE `company_desc` SET `title` =?, `Description`=?, `pictures`=?, `alt`=?  WHERE `id` = 1"
             ,array(url::post("desc_title"),
                    url::post("desc_text"),
                    $filepath,
                    url::post("desc_update_alt_tag")


                                              ));
         message::note('success');


         url::reload();



     }

     function contact_update(){



         $msg = $this->model->query("UPDATE `contact_info` SET `Street`=?,`description`=?,`email`=?,`city`=?,
                                            `country`=?,`Phone`=?,`zipcode`=?,`monday`=?,`tuesday`=?,`wednesday`=?,
                                            `thursday`=?,`friday`=?,`saturday`=?,`sunday`=? WHERE `id` = 1"
                         ,array(url::post("cont_street"),
                                url::post("cont_text"),
                                url::post("cont_email"),
                                url::post("cont_city"),
                                url::post("cont_country"),
                                url::post("cont_phone"),
                                url::post("cont_code"),
                                url::post("cont_monday"),
                                url::post("cont_tuesday"),
                                url::post("cont_wednesday"),
                                url::post("cont_thursday"),
                                url::post("cont_friday"),
                                url::post("cont_saturday"),
                                url::post("cont_sunday")
                                                            ));


             message::note('success!');




     }


     function updating_news()
     {

         if (file_exists($_FILES["uploadimage"]["name"] || is_uploaded_file($_FILES["uploadimage"]["tmp_name"]))) {
             $filepath = $this->pictureLink($_FILES["uploadimage"]);
         }
         else{
             $filepath = url::post("spareImage");
         }



             $msg = $this->model->query("UPDATE newspage SET Image=?, Description=?, Header=?, alt=?  WHERE  Page_ID=?"
                 , array($filepath,
                     url::post("update_news_text"),
                     url::post("update_news_header"),
                     url::post("news_update_alt_tag"),
                     url::post("Page_ID")

                 ));



         message::note('success!');




         url::reload();

         }
     function addDaily($id){
         var_dump($id);
         $msg = $this->model->query("INSERT INTO daily_product (`movie_id`,`date`) VALUES(?,NOW())",
             array($id));
         url::reload();
     }
     function deleteDaily($id){
         $msg = $this->model->query("DELETE FROM daily_product WHERE `movie_id`=?",
             array($id));
         url::reload();
     }

 }

