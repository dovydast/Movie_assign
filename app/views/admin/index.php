<?php load::view("admin::partial::panel");?>
<div style="background-color: #444444;" class="col-md-10 pull-right">
<?php
    $output = '';
    if(count($items) > 0){



        $output .= '';
        foreach($items as $movie){

            $output .=	'<div class="items thumbnail pull-right">  
<a  href="/Movie_assign/admin/product?p='.$movie['movie_id'].'">
           <div class="itemWhite">
           
            <img class="itemPicture" alt="'.$movie['alt'].'" src="/Movie_assign/assets/' . $movie['img'] . '">
            </div>
           
    <div class="itemInfoHide caption">
    <div class="transitionInformation">
         <h4>
         <strong>'.$movie['movie_title'].'</strong>
			</h4>
              <div class="otherInformation">
               Movie ID: <strong>' . $movie['movie_id'] . '</strong><br>
             Director:<strong>' . $movie['director'] . '</strong><br>
             Year:<strong>' . $movie['year'] . '</strong><br>
             Price:<strong>' . $movie['price'] . ' DKK</strong><br>
          
             
              </div>
    </div>
    </a>
    </div>
</div>
			';
        }
        echo $output;
    }
    else
    {
        echo ' ';
    }

    echo "";

    ?>
</div>

