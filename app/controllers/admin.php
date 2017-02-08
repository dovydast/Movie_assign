<?php
    class admin extends controller {

        function index(){
            if(common::isAdminLoggedIn()){

               admin::home();

            }
            elseif(url::post("username") && url::post("password")){
                    $admins = new admins_login();
                    $user = $admins->auth(url::post("username"),url::post("password"));
                    unset($_POST["username"]);
                    unset($_POST["password"]);
                    if(is_array($user)){
                        session::set("admin_id",$user["admin_id"]);
                        session::set("name",$user["name"]);
                        admin::home();
                    }
                    else{

                        url::redir("/Movie_assign/admin/index",1);

                    }
            }
            else{
                load::view("admin::login");
            }
        }
        static function invoke(){
            $edit = new edit();
            if(isset($_POST["logout"])){
                common::doAdminLogout();
                url::redir("/Movie_assign/admin/index");
            }

            if(isset($_POST["btn_insert_new"])){

               $edit->Add_Movie();
            }
            if(isset($_POST['delete_news'])){

                $edit->delete_news(url::post("Page_ID"));
            }
            if(isset($_POST["insert_news"])){

                $edit->addNews();
            }
            if(isset($_POST["btn_update"])){

                $edit->company_desc();
            }
            if(isset($_POST["btn-contact-update"])){

                $edit->contact_update();
            }
            if(isset($_POST["update_news"])){

                $edit->updating_news();
            }

            if(isset($_POST["btn_save_updates"])){

                $edit->updateMovie();
            }

            if(isset($_POST["btn_delete"])){
                $edit->deleteMovie(url::post("movie_id"));
                url::redir("/Movie_assign/admin/index");
            }

        }



        private function permission(){
            if(common::isAdminLoggedIn() == false){
                url::redir("/Movie_assign/admin/index");
            }
        }

         function home(){
             admin::permission();
             $main = new main_model();
            $data["items"] = $main->allMovies();
            load::view("admin::index",$data);
            admin::invoke();
        }
        function contacts(){
            admin::permission();
            $posts = new main_model();
            $data["contacts"] = $posts->contacts();
            load::view("admin::partial::panel");
            load::view("admin::partial::contacts",$data);
            admin::invoke();

        }
        function description(){
            admin::permission();
            $posts = new main_model();
            $data["description"] = $posts->description();
            load::view("admin::partial::panel");
            load::view("admin::partial::description",$data);
            admin::invoke();


        }
        function newsfeed(){
            admin::permission();
            $posts = new main_model();
            $data["news"] = $posts->posts(0);
            load::view("admin::partial::panel");
            load::view("admin::partial::newsfeed",$data);
            admin::invoke();


        }

        function movies(){
            admin::permission();
            $posts = new main_model();
            $data["news"] = $posts->posts(0);
            load::view("admin::partial::panel");
            load::view("admin::partial::movies",$data);
            admin::invoke();


        }

        function product(){
            admin::permission();
            if(url::get("p")){
                $posts = new main_model();
                $data["products"] = $posts->productId(url::get("p"));
                load::view("admin::partial::panel");
                load::view("admin::partial::products",$data);
                admin::invoke();


            }



        }
        function daily(){
            admin::permission();
            $posts = new main_model();
            $get = new edit();
            $data["daily"] = $posts->Daily();
            load::view("admin::partial::panel");
            if(isset($_POST["add_daily"])){
                unset($_POST["add_daily"]);
                $data["products"] = $posts->allMovies();

            }
            load::view("admin::partial::daily",$data);
            if(isset($_POST["add_item"])){
                unset($_POST["add_item"]);
                $id = url::post("Product_ID");
                $get->addDaily($id);
            }
            if(isset($_POST["deleteDaily"])){
                unset($_POST["deleteDaily"]);
                $id = url::post("deleteID");
                $get->deleteDaily($id);
            }
            admin::invoke();


        }

        function add_new(){
            admin::permission();

            load::view("admin::partial::panel");
            load::view("admin::partial::add");
            admin::invoke();

        }


    }
  //  db.diary.find({
  //      content: 'i like milk'
  //  }).update({
  //      content: 'i don't like milk'
  //})
