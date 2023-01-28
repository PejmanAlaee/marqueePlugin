
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<?php $posts = get_posts(['post_type' => 'neeews', 'post_status' => 'publish', 'numberposts' => -1
    // 'order'    => 'ASC'
]); ?>
<?php $ansId = '' ;
$args = array( 'post_type' => 'page', 'post_status' => 'publish');
$pages = get_pages($args);
foreach ( $pages as $page ) {
    if($page->post_title == 'allNews'){
        $ansId = $page->ID ;
    }
}
?>

<div class="container-fluid" style="width: 100% !important; ">
    <div class="row">
        <div class="col-sm-12">
            <?php  $count = count($posts);$flag = 3;?>
            <div class="slSh">
                <a href="<?php echo get_post_permalink(  $ansId )?>" class="shNews">اخبار فوری</a>
                <div class="marquee" id="mar">
                    <div style="display: flex;" id="divMar" onmouseout="startt(this)" onmouseover="stop(this)  ">
                        <?php $counterN = 0  ?>
                        <?php foreach($posts as $key => $dataaa) : ?>
                            <?php $typeNews= '' ; ?>
                            <?php  $selected = wp_get_object_terms($dataaa->ID, 'w', array('fields' => 'ids')); ?>
                            <?php foreach($selected as $key=>$data) : ?>
                                <?php  $typeNewsans =''; ?>
                                <?php  $selected_term_id = isset($data) ? $data : 0; ?> <?php foreach (get_terms('w', array('hide_empty' => 0)) as $term) : ?><?php if ($term->term_id == $selected_term_id) { ?><?php $typeNews =  $term->name; ?><?php } ?><?php endforeach; ?>
                                <?php if($typeNews == 'مهم'){
                                    $counterN = $counterN + 1 ;
                                } ?>
                            <?php endforeach; ?>

                            <?php if ( ($key <= 10 && $typeNews !='مهم') or ($key <= 10 && $typeNews =='مهم' && $counterN > 3)) { ?>
                                <a style="display: inline" class="textSl myTx" href= "<?php echo get_post_permalink(  $ansId )?>" >  <?php echo $dataaa->post_title?> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp | &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</a>
                            <?php } ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row rowTwoSlider" style="display: flex ; align-items: center ; justify-content: center; flex-direction: row ">
        <div class="getIt" style="width: 86% ;display: flex ; align-items: center ; justify-content: center; flex-direction: row  ">
        <?php $count = 0 ?>
        <?php foreach($posts as $key=>$dataa) : ?>
            <?php if($count <=2) { ?>
                <?php $typeNews= '' ; ?>
                <?php   $selected = wp_get_object_terms($dataa->ID, 'w', array('fields' => 'ids')); ?>
                <?php foreach($selected as $key=>$data) : ?>
                    <?php  $typeNewsans =''; ?>
                    <?php  $selected_term_id = isset($data) ? $data : 0; ?> <?php foreach (get_terms('w', array('hide_empty' => 0)) as $term) : ?><?php if ($term->term_id == $selected_term_id) { ?><?php $typeNews =  $term->name; ?><?php } ?><?php endforeach; ?>
                    <?php if($typeNews == 'مهم'){
                        $typeNewsans ='مهم';
                        break;
                    } ?>
                <?php endforeach; ?>
                <?php if ( $typeNewsans == 'مهم') { ?>
                    <div class="col-sm-4" style="margin-top: 4px">
                        <div class="divRowTwoStyle">
                            <?php $zh = get_the_post_thumbnail_url($dataa->ID , 'medium');  ?>
                            <img class="imageStylee" width="120"  src="<?php echo $zh ?>"/>
                            <span class=" w-100 txt" >
                    <?php echo $dataa->post_title  ?>
            </span>

                        </div>
                    </div>
                    <?php $count = $count + 1; } ?>
            <?php } ?>

        <?php endforeach; ?>
    </div>
    </div>
</div>
<script>
    function stop(){
        var divMar = document.getElementById("divMar");
        divMar.style.animationPlayState = 'paused';
    }
    function startt(){
        var divMar = document.getElementById("divMar");
        divMar.style.animationPlayState = 'running';
    }
    var myTx = document.getElementsByClassName("myTx");
    var myM = document.getElementsByClassName("marquee");
    var divSetTime = document.getElementById("divMar");
    var maxW = 0;
    var time = 0;
    var ansTime = myTx.length * 20  ;
    divSetTime.style.animation =  "marquee";
    divSetTime.style.animationTimingFunction =  "linear";
    divSetTime.style.animationIterationCount =  "infinite";
    divSetTime.style.animationDuration =ansTime + "s";
    if(window.innerWidth <480){

        var ansTime = myTx.length * 28  ;
        divSetTime.style.animationDuration = ansTime + "s";

    }else if( 480 < window.innerWidth && 1000 > window.innerWidth ){

        var ansTime = myTx.length * 26  ;
        divSetTime.style.animationDuration = ansTime + "s";

    }
</script>


<style>


    .imageStylee{
        width: 312px;
        height: 100px;
        border-top-left-radius: 4px;
        border-top-right-radius: 4px;
        border-bottom-left-radius: 12px;
        border-bottom-right-radius: 12px;
    }
    .marquee {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 70%;
        margin-left: 100px;
        height: 44px;
        overflow: hidden;
        position: relative;
    }

    .marquee div {
        display: block;
        position: absolute;
        overflow: hidden;
        padding-bottom: 16px;

    }

    @keyframes marquee {
        100% {transform: translateX(100%);}
        0% {transform: translateX(-60%);}
    }

    @-webkit-keyframes marquee {
        100% {transform: translateX(100%);}
        0% {transform: translateX(-60%);}
    }

    .marquee div:hover {
        animation-play-state: paused;
    }

    .marquee span {
        float: left;
    }

.shNews{
    text-decoration: none !important;
    font-family: 'AnjomanBold';
}

    .shNews:hover{
        text-decoration: none;
        color: #626060;
    }

    .shNews{
        background-color: white;
        font-size: 14px;
        color: black;
        height: 100%;
        padding-top: 10px;
        padding-left: 8px;
        padding-right: 8px;
    }

    .slSh{
        width: 100% ;
        background-color: #ed1a38 ;
        display: flex ;
        justify-content: center ;
        align-items: center;
        height: 44px;
        color: white;
    }

    .textSl {
        color: white;
        white-space: nowrap;
        text-align: right;
        font-size: 14px;
        font-family: 'AnjomanBold';
        padding-right: 20px;
        padding-top: 10px;
        text-decoration: none !important;
    }

    .textSl:hover{
        text-decoration: none;
        color: white;
    }

    .divRowTwoStyle{
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .rowTwoSlider{
        margin-top: 12px;
        margin-bottom: 10px;

    }

    .txt::-webkit-scrollbar {
        display: none;
    }

    .txt {
        font-family: 'AnjomanMedium';
        font-size: 12px;
        padding: 10px;
        height: 100px;
        overflow-y: scroll;
        -ms-overflow-style: none;
        scrollbar-width: none;
        text-align: right;
        padding-top: 10px;
    }

    @media screen and (max-width: 1000px) {
        .imageStylee{
            width: 300px;
            height: 80px;
        }
        .getIt{
            width: 100%;

        }
        .shNews{
            font-size: 12px;
            width: 1%;
            margin-right: 22px;
            text-align: center;
        }
        .shNews{
            font-size: 13px;
            width: 20%;
        }

    }
    @media screen and (max-width: 700px) {
        .rowTwoSlider{
            display: none !important;
        }

        .imageStylee{
            width: 150px;
            height: 60px;
        }
        .txt{
            width: 40%;
            font-size: 10px;
            height: 74px;
        }

    }

    @media screen and (max-width: 480px) {
        .txt{
            width: 100%;
            font-size:10px ;
        }

        .imageStylee{
            height: 50px;
            width: 150px;
        }
        .shNews{
            font-size: 14px;
            margin-right: 10px;
            padding: 2px 10px;
            width: 32%;
        }

        .divRowTwoStyle{
            margin-top: 6px;
        }
        .textSl{

            font-size: 12px;

        }
        .marquee{
            width: 100%;
            margin-left: -1px;
        }

    }
    @media screen and (max-width: 380px) {
        .shNews{
            font-size: 13px;
            width: 32%;
            margin-right: 10px;
        }
        .marquee{
            width: 100%;
            margin-left: -1px;
        }


    }
</style>
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jQuery.Marquee/1.5.0/jquery.marquee.min.js"></script>
