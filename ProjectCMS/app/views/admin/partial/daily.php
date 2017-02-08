<div class="col-md-9">

    <?php
    $output ='';
    $count = 0;
    if(count($daily) < 5){
         $count = 5 - count($daily);
    }

    foreach( $daily as $product) {
        $tags = explode(" ",$product['tags'], 3);
        $output .='
<form method="post">
        <div class="item-por">
<div class="items center-block">
    <a href="/ProjectCMS/main/product?p='. $product['movie_id'].'">
        <div class="itemWhite">
            <img class="itemPicture" src="/ProjectCMS/assets/'. $product['img'].'">
        </div>
        <div class="itemInfoHide caption">
            <div class="transitionInformation text-left">
            <h4>
                <strong>
                    '. $product['movie_title'].'
                </strong>
		    </h4>
		     <h4>
                <strong>
                    '. $product['year'].'
                </strong>
		    </h4>
		    <h4>
		        <strong>
		            '. $product['price'].' DKK
		        </strong>
		    </h4>
            <h4>
                ' . $product['upVote'] . '
            </h4>
            ';
            foreach( $tags as $tag){
                $output .= "<span class='label label-default'>" . $tag . "</span> ";
            }
        $output .= '
            <input type="hidden" name="deleteID" value="'.$product['movie_id'].'" /><br/>
            <button type="submit" name="deleteDaily">Delete daily item</button>

            </div>
        </div>
    </a>
</div>
</div>
			</form>';

    }
    for($i = 0; $i < $count; $i++){

        $output .= '<form method="post">
<div class="item-por">
<div class="items center-block">
                   <button type="submit" name="add_daily">Add daily product</button>
                   </div>
</div>
                   </form>';
    }
    $output .= "<div class='container-fluid'>
                <div class='panel panel-default'>
    ";
    if(!empty($products)) {
        foreach($products as $product ){
            $output .='
<form method="post"><div class="items thumbnail pull-right">  
           <div class="itemWhite">
           
            <img class="itemPicture" alt="'.$product['alt'].'" src="/ProjectCMS/assets/' . $product['img'] . '">
            </div>
           
    <div class="itemInfoHide caption">
    <div class="transitionInformation">
         <h4>
         <strong>'.$product['movie_title'].'</strong>
			</h4>
              <div class="otherInformation">
                ID - <strong>' . $product['movie_id'] . '</strong><br>
            
          
             <strong>' . $product['year'] . '</strong><br>
             <strong>' . $product['price'] . ' DKK</strong><br>
      
             <input type="hidden" name="Product_ID" value="'. $product['movie_id'] .'" />
             <button type="submit" name="add_item">Add this product <strong>+</strong></button>
              </div>
    </div>
    </a>
    </div>
</div>
</form>';
        }
    }
    $output .= '</div>
                    </div>
    ';
    echo $output;
    ?>
</div>
