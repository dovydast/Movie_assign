<?php
class main extends controller {

    static function index(){

        $posts = new main_model();
        $news = $posts->posts(3);
        $data["news"] = $news;
        $name = main::recommend();
        $data["name"] = $name["name"];
        $data["daily"] = $name["daily"];
        main::prod();
        main::head();
        load::view("main::index",$data);
        main::foot();
        if(isset($_POST["lead"])){
            $posts->discounted("");
            load::view("main::discount");
        }
    }
    static function ajax(){
        if(isset($_POST["add_to_cart"])){
            unset($_POST["add_to_cart"]);
            $data["LOC"] = session::get("LOC");
             $cart = session::get("cart");
            if(session::check("cart")){
                array_push($cart, $data["LOC"]);

            }
            else {
                $cart = array(
                    0 => $data["LOC"]
                );
            }
            session::set("cart",$cart);
        }
        if(isset($_POST["up_vote"])){
            unset($_POST["up_vote"]);
            if(common::isUserLoggedIn()){
                $id = session::get("LOC");
                $vote = session::get("up");
                if(empty($vote)) {
                    $vote = array();
                    array_push($vote,$id);
                }
                else {
                    array_push($vote,$id);
                }
                $posts = new main_model();
                $posts->upVote($id);
                session::set("up",$vote);
            }
        }
    }
    static function head(){
        $posts = new main_model();
        $main = new admins_login();
        main::ajax();
        if(isset($_POST["login"])) {
            unset($_POST["login"]);
            $main->user_auth(url::post("username"),url::post("password"));

        }
        if(isset($_POST["submit_comment"])){
            $mess = $posts->postComment(session::get("username"),url::get("p"),url::post("comment"));
            echo $mess;
        }

        load::view("partial::nav");

    }
    function logout(){
        common::doUserLogout();
        url::redir("/ProjectCMS/main/index");
    }
    function product(){
        $posts = new main_model();
        if(url::get("p")){
            $data["products"] = $posts->productId(url::get("p"));
            $data["comments"] = $posts->comments(url::get("p"));
            main::head();
            load::view("main::viewProduct",$data);
            main::foot();
        }
        else{
            url::redir("/ProjectCMS/",3);
        }

    }
    static function foot(){
        load::view("partial::foot");
    }

    function news(){
        $posts = new main_model();
        $data["news"] = $posts->posts(0);
        $name = main::recommend();
        $data["name"] = $name["name"];
        $data["daily"] = $name["daily"];
        main::head();
        load::view("main::news",$data);
        main::foot();
    }
    function register(){
        main::head();

        load::view("main::register");
        main::foot();

        if(isset($_POST["register"])) {
            $posts = new admins_login();
            $posts->register(url::post("username"),url::post("password"),url::post("email"));
        }
    }
    function info(){
        $posts = new main_model();
        $data["description"] = $posts->description();
        $data["contacts"] = $posts->contacts();
        main::head();
        load::view("main::contact",$data);
        main::foot();
    }

    static function recommend(){
        $ran = rand(0,2);
        $model = new main_model();

        switch ($ran) {
            default;
                $data["daily"] = "";
                $data["name"] = "";
                return $data;
                break;
            case 0;
                $data["daily"] = $model->most_viewed();
                $data["name"] = 'Most viewed on shop!';
                return $data;

                break;
            case 1;
                $data["daily"] = $model->Daily();
                $data["name"] = 'Daily special pick!';
                return $data;

                break;
            case 2;
                $data["daily"] = $model->most_liked();
                $data["name"] = 'Everyone love these ones!';
                return $data;
                break;
        }
    }
    function basket(){
        if(session::check("cart")){
            $fata = session::get("cart");
            $main = new main_model();
            $data["basket"] = $main->basket($fata);
            main::head();
            load::view("main::basket",$data);
            main::foot();
        }
        else {
            main::head();
            load::view("main::basket");
            main::foot();
        }
        if(isset($_POST["deleteItem"])){
            unset($_POST["deleteItem"]);
            $id = url::post("Product_ID");
            $cart = session::get("cart");
            if(($key = array_search($id,$cart)) !== false){
                unset($cart[$key]);
                session::set("cart",$cart);
                url::reload();
            }
            else {
                url::reload(11);
            }
        }
        if(isset($_POST["clear_all"])){
            unset($_POST["clear_all"]);
            session::set("cart",array());
            url::reload();
        }
    }
    private static function prod(){
        $products = new main_model();
        $items = $products->allMovies();
        if(file_exists("data.json")){
            $delete = file_get_contents("data.json");

        }
        else {
            fopen('data.json', 'w/');
        }
        $jso = json_encode($items);
        file_put_contents("data.json",$jso);
    }
    function profile(){
        $main = new admins_login();

        if(common::isUserLoggedIn()){
            $data["profile"] = $main->profile(session::get("username"),session::get("user_id"));
            if($data["profile"] != false){
                main::head();
                load::view("main::profile",$data);
                main::foot();
            }
            else {
                url::redir("/Movie_assign/main/index",7);
            }
        }
        else{
            url::redir("/Movie_assign/main/index",7);
        }
        if(isset($_POST["update_profile"])){
            $msg = $main->updateProfile(url::post("firstName"),url::post("lastName"),url::post("Address"),url::post("birthDay"));

        }
        if(isset($_POST["update_password"])){
            $msg = $main->updatePassword(url::post("current_pass"),url::post("new_pass"),url::post("new_pass_re"));
        }
    }

}