
            <div class="row">
                <div class="col-md-9">
                    <div class="welcome-tile">
                        <h1 class="text-right">
                            <strong>...Winter is coming</strong>
                        </h1>

                        <h4 class="text-right">But no until Movie winter sales rampage!<br/>
                            Here at MovieShop time of the year doesn't really matter since<br />
                            we always treat our customers, and not only on holidays.<br /></h4>
                        <p class="text-right"><span class="label label-primary">New movies every day, stupidly low prices, rare stock</span></p>
                        <p class="text-right"><button type="button" name="lead" class="btn btn-default btn-lg" >Take a peek...</button></p>

                    </div>
                </div>
                <div class="col-md-3">
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner" role="listbox">
                                    <?php
                                    $output = '';
                                    foreach($news as $new ){
                                        if(empty($output)) {


                                            $output .=  "<!-- Wrapper for slides -->
        <div class='item active'>
            <img class='bound-img' src='/Movie_assign/assets/" .  $new['Image'] . "' alt='".$new['alt']."'>
            <div class='carousel-caption'>
                <h3>" .  $new['Header'] . "</h3>
                <p>" . $new['Description'].  "</p>
            </div>
        </div>";

                                        }
                                        else {
                                            $output .=  "<!-- Wrapper for slides -->
        <div class='item'>
            <img class='bound-img' src='/Movie_assign/assets/" .  $new['Image'] . "' alt='...'>
            <div class='carousel-caption'>
                <h3>" .  $new['Header'] . "</h3>
                <p>" . $new['Description'].  "</p>
            </div>
        </div>";


                                        }
                                    }
                                    echo $output;
                                    ?>
                                </div>

                                <!-- Controls -->
                                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>

                        </div>

                    </div>
                    <?php
                    $output = '';
                    $pro = file_get_contents('data.json');
                    $prom = json_decode($pro);


                    $no = 0;
                    foreach($prom as $product) {
                        if($no < 16){

                        if (!isset($num) || $num == 4) {
                            $num = 0;
                        }

                        if ($num == 0) {
                            $output .= '<div class="row">';
                        }
                        $tags = explode(' ', $product->tags, 3 );

                        $output .= '
<div class="col-md-3 item-por">
    <div class="items">
        <a href="/Movie_assign/main/product?p=' . $product->movie_id . '">
            <div class="itemWhite">
                <img class="itemPicture" alt="'.$product->alt.'" src="/Movie_assign/assets/' . $product->img . '">
            </div>
            <div class="itemInfoHide caption">
                <div class="transitionInformation">
                 <h4>
                     <strong>' . $product->movie_title . '</strong> <p>' . $product->year . '</p>
    			 </h4>
    			 <p><strong><span class="label label-danger">' . $product->tags . '</span></strong></p>
    			 
                 <p style="font-size:24px;" class="pull-right"><strong>' . $product->price . ' DKK</strong></p><br>
                 
                </div>
            </div>
        </a>
    </div>
</div>			';
                        if($num == 3){
                            $output .= '</div>';
                        }
                        $num++;
                    $no++;
                        }
                        else $output .= "";
                    }


                    echo $output;

                    ?>

                </div>
                <div class="col-md-3">
                    <?php
                    $data["name"] = $name;
                    $data["daily"] = $daily;
                    load::view("partial::daily",$data);
                    ?>
                </div>
            </div>
