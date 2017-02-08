<div class="col-md-9">
    <div class="container-fluid">

    <form method="post" enctype="multipart/form-data">
        <div class="panel panel-default">
        <div class="container-fluid">

        <div class="item">
		<div class="row">
			<div class="col-md-6">
				<div class="itemImageFrame">
					<img class="itemPictureBig thumbnail" src="">
					<br>

					<input class="input-group" type="file" name="uploadimage"/>
					<Br>
					<div class="panel panel-default">
						<li class="list-group-item">Image alt tag<strong><input name="movie_alt_tag" id="product_input" type="text"></strong></li>
					</div>
					<br>
					<div class="panel panel-default">
						<li class="list-group-item">Youtube URL<strong><input name="youtube" id="product_input" type="text"></strong></li>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="itemInformation pull-right">

<div class="panel panel-default">

  <!-- Default panel contents -->
  <li class="list-group-item">Movie_ID<strong><input name="movie_id" id="product_input" type="text" value=""></strong></li>
  	<div class="panel-heading"><h3>Title<strong><input name="movie_title" placeholder="Movie title" id="product_input" type="text" value=""</strong></h3><br/>
  	</div>
  		<div class="panel-body">
  			<h4>Price: in DKK<strong><input name="movie_price" id="product_input" type="text" value="" ></strong></h4><br/>

		</div>
  <!-- List group -->
  				<ul class="list-group">

  	<li class="list-group-item">Description:<strong><textarea class="form-control" id="userComment" rows="4" cols="100" name="movie_desc" placeholder="Add text"></textarea></strong></li>
    <li class="list-group-item">Movie year<strong><input name="movie_year" id="product_input" type="text" value=""></strong></li>
    <li class="list-group-item">Director<strong><input name="movie_dir" id="product_input" type="text" value=""></strong></li>
					<li class="list-group-item">Tags<strong><input name="movie_tags" id="product_input" type="text" value=""></strong></li>
  				</ul>

		</div>
	<a href="/ProjectCMS/admin/index"><button type="button" class="pull-left btn-lg btn btn-default">Back <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></button></a>

	<button type="submit" name="btn_insert_new"  class="pull-left btn-lg btn btn-primary">Add new <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>

  </div>
  </div>

				</div>
        </div>
			</div>
        </div>
</form>

    </div>
</div>


