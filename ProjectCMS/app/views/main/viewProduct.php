<?php
$product = $products;
$data["LOC"] = session::get("LOC");
if(empty($data["LOC"]) || $data["LOC"] != $product['movie_id']){
  //  $data["one"] = $product['upVote'];
    $data["LOC"] = $product['movie_id'];
    session::set("LOC",$data["LOC"]);
}
?>
<div class="item container-fluid" xmlns="http://www.w3.org/1999/html">
    <div class="row">
        <div class="col-md-6">
            <div class="itemImageFrame panel panel-default">
                <img class="itemPictureBig thumbnail" alt="<?php echo $product['alt'] ?>" src="/ProjectCMS/assets/<?php echo $product['img']; ?>"><br />
                <div class="btn-group productControl text-center">
                    <form method="post">
                        <button id="cart" name="add_to_cart" type="submit" class="btn-lg btn btn-success">Add to basket <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></button>
                        <?php
                            if(common::isUserLoggedIn() && session::check("up")){
                                $array = session::get("up");
                                    if(empty($array)){
                                        $array = array();
                                        session::set("up",$array);
                                    }
                                    if(is_int(array_search($product["movie_id"],$array))){
                                        echo '<button type="submit" disabled="disabled" class="btn-lg btn btn-success">Up vote <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span></button>';
                                    }
                                    else {
                                     echo '<button id="up" type="submit" name="up_vote" class="btn-lg btn btn-success">Up vote <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span></button>';
                                    }

                            }
                            else {
                                echo '';
                            }
                        ?>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="itemInformation">

                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-body">
                        <!-- List group -->
                        <ul class="list-group">
                            <li class="list-group-item"><h3><strong><?php echo $product['movie_title']; ?></h3></strong></li>
                            <li class="list-group-item">Price: <strong><?php echo $product['price']; ?> DKK</strong></li>
                            <li class="list-group-item">Description: <strong><?php echo $product['movie_desc']; ?></strong></li>

                            <li class="list-group-item">Tags: <strong class="tags"> <?php

                                    $tags =  explode( " ",$product['tags']);
                                    foreach($tags as $tag){
                                        echo '<span class="label label-default">' . $tag . '</span> ';
                                    }

                                    ?></strong></li>
                            <li class="list-group-item">Views:<strong> <?php echo $product['views']; ?></strong></li>
                            <li class="list-group-item">Up votes:<strong> <?php echo $product['upVote']; ?></strong></li>
                            <li class="list-group-item"><iframe width="565" height="315" src="https://www.youtube.com/embed/<?php echo substr($product['youtube'],-11)?>" frameborder="0" allowfullscreen></iframe></li>

                        </ul>

                    </div>

                </div>
            </div>

        </div>
    </div>		<!--Product end-->
    <div class="row">
        <div class="col-md-12">
            <div id="postNew" class="panel panel-default">
                <form method="post">
                    <?php

                    if(session::check("user_id")) {
                        echo '
					<div class="form-group">
						<label for="userNameInput">User:</label>
						<input type="text" id="userNameInput" disabled="disabled" class="form-control" name="postName" value="' . session::get("username") . '">
					</div>
					<div class="form-group">
						<label for="userComment">Comment:</label>
						<textarea class="form-control" id="userComment" rows="4" name="comment" placeholder="What do you think about product?"></textarea>
					</div>
					<div class="g-recaptcha" data-sitekey="6LcGRQwUAAAAACSHXYarFIy5rp_iat0ymtFQnaHD"></div>
     <!-- <div class="g-recaptcha" data-sitekey="6LcDRQwUAAAAAOgAEugcGPzAui8LOAakDd0huLn_"></div> - for examserver38.dk -->
					<br />
					<input type="submit" class="btn btn-primary" name="submit_comment">
				';
                    }
                    else {
                        echo '<h3>Only registered users are allowed to comment.</h3>';
                    }
                    ?>
                </form>


            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9">
            <div id="commentSection">
                <div id="echo">
                    <?php
                    $output = '';

                    if($comments != false || !empty($comments))
                    {

                    foreach($comments as $comment){
                        if(common::isUserLoggedIn()){


                    $output .=	'
                    <div class="panel panel-default">
                        <div class="panel-heading"><div class="row">
                            <div class="col-md-12 text-left"><strong>'. $comment['name'] .'</strong>
                            </div> 
                               
                            </div>
                        </div>
                        <div class="panel-body">
                            <h5>'. $comment['Comments'] .'</h5>
                        </div>

                    </div>
                    ';
                    }
                    else {
                        $output .=	'
                    <div class="panel panel-default">
                        <div class="panel-heading"><div class="row">
                            <div class="col-md-12 text-left"><strong>'. $comment['name'] .'</strong>
                            </div> 
                                
                            </div>
                        </div>
                        <div class="panel-body">
                            <h5>'. $comment['Comments'] .'</h5>
                        </div>

                    </div>
                    ';
                    }
                        }

                        echo $output;
                    }
                    else
                    {
                    echo '<div class="notFound panel panel-default">
                        <h2>No comments. Be the first one to comment!</h2>
                    </div>';
                    }
                    ?>
                </div>

            </div>
        </div>
        <div class="col-md-3">
            <div class="jumbotron">free space</div>
        </div>
    </div>

    <script>
        /*	$(document).ready(function() {
         function getComments(url) {
         $.ajax({
         url: url,
         type: "GET",
         data: {rowCount: $('.rowcount').val()},
         beforeSend: function () {
         $('#loader-icon').show();
         },
         complete: function () {
         $('#loader-icon').hide();
         },
         success: function (data) {
         $("#echo").append(data);
         },
         error: function () {
         }

         });
         }

         var number = $('.pagenum:last').val();

         //	var count;
         $(window).scroll(function () {
         if ($(window).scrollTop() == $(document).height() - $(window).height()) {

         if (number <= $(".rowcount").val()) {
         var pagenum = parseInt(number)+5;
         getComments('controller/comments.php?current='+pagenum);
         }
         }
         });
         });
         /*	$(document).ready(function(){
         function getresult(url) {
         $.ajax({
         url: url,
         type: "GET",
         data:  {rowcount:$("#rowcount").val()},
         beforeSend: function(){
         $('#loader-icon').show();
         },
         complete: function(){
         $('#loader-icon').hide();
         },
         success: function(data){
         $("#faq-result").append(data);
         },
         error: function(){}
         });
         }
         $(window).scroll(function(){
         if ($(window).scrollTop() == $(document).height() - $(window).height()){
         if($(".pagenum:last").val() <= $(".total-page").val()) {
         var pagenum = parseInt($(".pagenum:last").val()) + 1;
         getresult('getresult.php?page='+pagenum);
         }
         }
         });
         });*/
    </script>


</div>