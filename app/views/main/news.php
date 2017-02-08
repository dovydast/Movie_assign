<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <?php
            $data["name"] = $name;
            $data["daily"] = $daily;
            load::view("partial::daily",$data);
            ?>
        </div>
        <div class="col-md-9">

            <?php
            $output = '';
                foreach($news as $post){

                    $output .=	'

        <div class="panel panel-default">
            <div class="panel-body">
            <div class="row">
            <div class="col-md-6">
                <img alt="'. $post['alt'] .'" class="postImage img-responsive" src="/Movie_assign/assets/'.$post['Image'].'">
            </div>
            <div class="col-md-6">
              <h1>'.$post['Header'].'</h1>
                '.$post['Description'].'
            </div>
            </div>
            </div>
            <div class="panel-footer">
                '.$post['DATE'].'
            </div>
        </div>
			';
                }
                echo $output;
            ?>
        </div>
    </div>
</div>