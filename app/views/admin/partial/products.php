<div class="col-md-9">
<?php

$product = $products;


   if(session::check('LOC') == false || session::get('LOC') != $product['movie_id']){
       session::set("LOC",$product['movie_id']);
   }

echo '   <form id="adminform" method="post" enctype="multipart/form-data">
	<div class="item container-fluid">
		<div class="row">
			<div class="col-md-6">
				<div class="itemImageFrame">
					<img class="itemPictureBig thumbnail" alt="'.$product['alt'].'" src="/ProjectCMS/assets/' . $product['img'] . '">
					<br>
					<input class="input-group" type="file" name="uploadimage"/>
					<br>
					<div class="panel panel-default">
					 <li class="list-group-item"><iframe width="400" height="315" src="https://www.youtube.com/embed/'.substr($product['youtube'],-11).'" frameborder="0" allowfullscreen></iframe></li>
					  <li class="list-group-item">Image alt tag<strong><input name="movie_alt" id="product_input" type="text" value="' . $product['alt'] . '"></strong></li>
					  <li class="list-group-item">Youtube URL<strong><input name="movie_youtube" id="product_input" type="text" value="' . $product['youtube'] . '"></strong></li>
					</div>
					
					<input type="hidden"  value="'.$product['img'].'" name="spareImage"/>
				</div>
			</div>
			
			<div class="col-md-6">
				<div class="itemInformation pull-right">
	
<div class="panel panel-default">

  <!-- Default panel contents -->
  <li class="list-group-item">Movie_ID<strong><input name="movie_id" id="product_input" type="text" value="' . $product['movie_id'] . '"></strong></li>	
  	<div class="panel-heading"><h3><strong><input name="movie_title" placeholder="Product Name" id="product_input" type="text" value="' . $product['movie_title'] . '"</strong></h3><br/>
  	</div>
  		<div class="panel-body">
  			<h4>Price: in DKK<strong><input name="movie_price" id="product_input" type="text" value="' . $product['price'] . '" ></strong></h4><br/>
				
		</div>
  <!-- List group -->
  				<ul class="list-group">
  	<li class="list-group-item">Description:<strong>  			<textarea class="form-control" id="userComment" rows="10" cols="70" name="movie desc">'.$product['movie_desc'].'</textarea></strong></li>			
    <li class="list-group-item">Director:<strong><input name="movie_dir" id="product_input" type="text" value="' . $product['director'] . '"></strong></li>
    <li class="list-group-item">Year:<strong><input name="movie_year" id="product_input" type="text" value="' . $product['year'] . '"></strong></li>
    <li class="list-group-item">Tags<strong><input name="movie_tags" id="product_input" type="text" value="' . $product['tags'] . '"></strong></li>

  				</ul>
  				
		</div>
	<a href="/ProjectCMS/admin/index"><button type="button" class="pull-left btn-lg btn btn-default">Back <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></button></a>
	
	<button type="submit" name="btn_save_updates"  class="pull-left btn-lg btn btn-primary">Update <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></button>
	
    <button  name ="btn_delete" title="Click to Delete" onclick="return confirm(\'Are you sure you want to delete it?\')" type="submit" class="pull-left btn-lg btn btn-danger">Delete <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span></button><br/>
  </div>
  </div>
	
				</div>
			</div>
		</div>
    </div></form>';

?>

<!--Product end

<iframe width="560" height="315" src="https://www.youtube.com/embed/Q8g9zL-JL8E" frameborder="0" allowfullscreen></iframe>
-->
<div id="color2" class="row">
    <div class="col-md-12">
        <div id="postNew" class="container">


            <div class="row" id="commentsection">
                <div class="col-md-9">
                    <div id="commentSection" class="container">

                        <div id="rowcount">

                        </div>
                        <div id="echo">
                            <?php //require 'controller/admin_comments.php'; ?>
                        </div>

                    </div>
                </div>
                <div class="col-md-3">

                </div>
            </div>

        </div>
    </div>

</div>
</div>
