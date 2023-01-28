
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<?php $posts = get_posts(['post_type' => 'neeews', 'post_status' => 'publish', 'numberposts' => -1
    // 'order'    => 'ASC'
]); ?>

<div class=" container" style="margin-top: 40px ; font-family:'Anjoman' ">
    <div class="row">
        <div class="col-sm-12" style=" border-bottom: 1px solid #053755;">
            <div style="display: flex ; justify-content: center ; align-items: center ; font-family: 'AnjomanBold';">
                <span id="allSpan"><button id="allNews">همه</button></span>
                <span id="domesticSpan"><button id="domesticNews">خارجی</button></span>
                <span id="foreignSpan"><button id="ForeignNews"> داخلی</button></span>

            </div>
        </div>
    </div>
    <div id="mainInfoRes">
        <?php
        $counterAllNews = 0 ;
        foreach($posts as $key => $dataa) : ?>
            <?php if($counterAllNews <40){?>
                <div class="row" style="margin-top: 20px">
                    <div class="col-sm-12" style="display: flex ; justify-content: center ; align-items: center ; ">
                        <div class="styleContainerRow" style="width: 80% ; display: flex ;border-bottom: 1px solid rgb(236, 239, 241)">
                                <span class="imageSt" style="display: flex; width: 18% ; ">
                                <?php $zh = get_the_post_thumbnail_url($dataa->ID, 'medium'); ?>
                                 <img class="imageFileNews" src="<?php echo $zh ?>"/>
                                </span>
                            <span class="textRow" style="width: 80% ;">
                        <div class="textTitle"> <?php echo $dataa->post_title  ?></div>
                             <?php $link = get_post_meta($dataa->ID, '_hmci_news_Link') ?><?php if (!isset($link[0])) $link[0] = "" ?>
                                <?php $linkUrl = get_post_meta($dataa->ID, '_hmci_news_Link_url') ?><?php if (!isset($linkUrl[0])) $linkUrl[0] = "" ?>
                          <div class="textInformation"> <?php $txt = get_post_meta($dataa->ID, '_hmci_news_discription') ?><?php if (!isset($txt[0])) $txt[0] = "" ?><?php echo $txt[0] ?>  <div class="linkS"><a style="text-decoration: none ;  color: gray ; font-size: 11px ; font-weight: 800;" href="<?php echo $linkUrl[0] ?>">منبع خبر:   <?php echo $link[0] ?></a></div></div>
                        </span>
                        </div>
                    </div>
                </div>
                <?php
                $counterAllNews+=1;
            } ?>
        <?php endforeach; ?>
    </div>

    <div id="mainInfoDomestic" style="display: none">
        <?php
        $counter = 0 ;
        $counterDomesticNews = 0 ;
        foreach($posts as $key => $dataa) : ?>
            <?php $typeNews= '' ; ?>
            <?php   $selected = wp_get_object_terms($dataa->ID, 'w', array('fields' => 'ids')); ?>
            <?php  $selected_term_id = isset($selected[0]) ? $selected[0] : 0; ?> <?php foreach (get_terms('w', array('hide_empty' => 0)) as $term) : ?><?php if ($term->term_id == $selected_term_id) { ?><?php $typeNews =  $term->name; ?><?php } ?><?php endforeach; ?>
            <?php  if($typeNews   =='خارجی') { ?>
                <?php if($counterDomesticNews<15){ ?>
                    <div class="row" style="margin-top: 20px">
                        <div class="col-sm-12"style="display: flex ; justify-content: center ; align-items: center ; ">
                            <div class="styleContainerRow" style="width: 80% ;display: flex ;border-bottom: 1px solid rgb(236, 239, 241)">
                                    <span class="imageSt" style="display: flex; width: 18% ;">
                                <?php $zh = get_the_post_thumbnail_url($dataa->ID, 'medium'); ?>
                                      <img class="imageFileNews" width="120" src="<?php echo $zh ?>"/>
                                    </span>
                                <span class="textRow" style="width: 80% ;">
                                     <div class="textTitle"> <?php echo  $dataa->post_title ?></div>
                                     <?php $link = get_post_meta($dataa->ID, '_hmci_news_Link') ?><?php if (!isset($link[0])) $link[0] = "" ?>
                                    <?php $linkUrl = get_post_meta($dataa->ID, '_hmci_news_Link_url') ?><?php if (!isset($linkUrl[0])) $linkUrl[0] = "" ?>
                                    <div class="textInformation"> <?php $txt = get_post_meta($dataa->ID, '_hmci_news_discription') ?><?php if (!isset($txt[0])) $txt[0] = "" ?><?php echo $txt[0] ?>  <div class="linkS"><a style="text-decoration: none ;  color: gray ; font-size: 11px ; font-weight: 800;" href="<?php echo $linkUrl[0] ?>">منبع خبر: <?php echo $link[0] ?> </a></div></div>
                            </span>
                            </div>
                        </div>
                    </div>
                <?php }
                $counterDomesticNews+=1;
            }?>
        <?php endforeach; ?>
    </div>
    <div id="mainInfoForeign" style="display: none">
        <?php
        $counterForeignNews=0;
        foreach($posts as $key => $dataa) : ?>
            <?php $typeNews= '' ; ?>
            <?php   $selected = wp_get_object_terms($dataa->ID, 'w', array('fields' => 'ids')); ?>
            <?php  $selected_term_id = isset($selected[0]) ? $selected[0] : 0; ?> <?php foreach (get_terms('w', array('hide_empty' => 0)) as $term) : ?><?php if ($term->term_id == $selected_term_id) { ?><?php $typeNews =  $term->name; ?><?php } ?><?php endforeach; ?>
            <?php  if($typeNews   =='داخلی'){ ?>
                <?php if($counterForeignNews<15){ ?>
                    <div class="row" style="margin-top: 20px">
                        <div class="col-sm-12"style="display: flex ; justify-content: center ; align-items: center ; ">
                            <div class="styleContainerRow" style="width: 80% ;display: flex ;border-bottom: 1px solid rgb(236, 239, 241)">
                                    <span class="imageSt" style="display: flex; width: 18% ;">
                                <?php $zh = get_the_post_thumbnail_url($dataa->ID, 'medium'); ?>
                                      <img class="imageFileNews" width="120" src="<?php echo $zh ?>"/>
                                    </span>
                                <span class="textRow" style="width: 80% ;">
                                    <div class="textTitle"> <?php echo $dataa->post_title ?></div>
                                        <?php $link = get_post_meta($dataa->ID, '_hmci_news_Link') ?><?php if (!isset($link[0])) $link[0] = "" ?>
                                    <?php $linkUrl = get_post_meta($dataa->ID, '_hmci_news_Link_url') ?><?php if (!isset($linkUrl[0])) $linkUrl[0] = "" ?>
                                     <div class="textInformation"> <?php $txt = get_post_meta($dataa->ID, '_hmci_news_discription') ?><?php if (!isset($txt[0])) $txt[0] = "" ?><?php echo $txt[0] ?>  <div class="linkS"><a style="text-decoration: none ;  color: gray ; font-size: 11px ; font-weight: 800;" href="<?php echo $linkUrl[0] ?>">منبع خبر: <?php echo $link[0] ?> </a></div></div>
                                    </span>
                            </div>
                        </div>
                    </div>
                <?php }
                $counterForeignNews+=1;
            } ?>
        <?php endforeach; ?>
    </div>

</div>

<style>
    @font-face {
        font-family: 'AnjomanMedium';
        font-style: normal;
        src:url("Anjoman-Medium.ttf");

    }
    @font-face {
        font-family: 'AnjomanBold';
        font-style: normal;
        src:url("Anjoman-Bold.ttf");

    }

    #domesticNews{
        border: none;
        background-color: rgb(238, 238, 238);
        color: rgb(26, 35, 126);
        width: 110px;
    }
    #ForeignNews{
        border: none;
        background-color: rgb(238, 238, 238);
        color: rgb(26, 35, 126);
        width: 110px;
    }
    #allNews{
        border: none;
        background-color: rgb(238, 238, 238);
        color: rgb(26, 35, 126);
        width: 110px;
    }

    .textTitle{
        background-color: #053755;
        padding: 10px 14px;
        color: white;
        text-align: right;
        font-size: 13px;
        font-family: 'AnjomanBold';

    }
    .textInformation{
        text-align: right;
        padding: 8px 14px;
        font-size: 13px;
        color: #141436; ;
        font-family: 'AnjomanMedium';

    }
    #foreignSpan{
        padding: 0px 2px;
    }

    #allSpan{
        padding: 0px 2px;
    }
    #domesticSpan{
        padding: 0px 2px;
    }
    @media screen and (max-width: 480px) {
        .styleContainerRow{
            display: flex;
            flex-direction: column !important;
            justify-content: center !important;
            align-items: center;
            width: 100% !important;
        }
        .imageSt{
            height: 200px;
            width: 100% !important;


        }
        .imageFileNews{
            height: 180px !important;
            width: 100% !important;

        }
        .textRow{
            margin-top: -20px;
            width: 94% !important;
        }
        .textTitle{
            margin-top:-10px ;

        }
    }
    @media (min-width: 480px) and (max-width: 1200px){
        .imageSt{
            width:26% !important;
        }
    }


    .linkS{
        text-decoration: none;
    }
    #domesticNews{
        background-color: #f8f6f6;
        padding: 8px 0px;
    }
    #ForeignNews{
        background-color: #f8f6f6;
        padding: 8px 0px;
    }
    #allNews{
        background-color: #f8f6f6;
        padding: 8px 0px;
    }
    .imageFileNews{
        border-top-left-radius: 4px;
        border-top-right-radius: 4px;
        border-bottom-left-radius: 12px;
        border-bottom-right-radius: 12px;
        padding-bottom: 10px;
    }
    .textTitle{
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;

    }

</style>

<script>

    const mainInfo = document.querySelector('#mainInfoRes');
    const z = document.querySelector('#mainInfoDomestic');
    const fn = document.querySelector('#mainInfoForeign');
    const nextDomesticNews = document.querySelector('#domesticNews');
    const allNews = document.querySelector('#allNews');
    const ForeignNews = document.querySelector('#ForeignNews');
    nextDomesticNews.addEventListener("click", myFunction);

    function myFunction() {
        allNews.style.backgroundColor = ' #f8f6f6';
        ForeignNews.style.backgroundColor = ' #f8f6f6';
        nextDomesticNews.style.backgroundColor = '#053755';
        nextDomesticNews.style.color = 'white';
        ForeignNews.style.color = 'black';
        allNews.style.color = 'black';
        mainInfo.style.display = 'none';
        fn.style.display = "none";
        z.style.display = "block";
    }
    allNews.addEventListener("click", myFunctionAllNews);
    function myFunctionAllNews() {
        ForeignNews.style.backgroundColor = ' #f8f6f6';
        nextDomesticNews.style.backgroundColor = '#f8f6f6';
        allNews.style.backgroundColor = '#053755';
        nextDomesticNews.style.color = 'black';
        ForeignNews.style.color = 'black';
        allNews.style.color = 'white';
        fn.style.display = "none";
        z.style.display = 'none';
        mainInfo.style.display = "block";
    }
    ForeignNews.addEventListener("click", myFunctionFn);
    function myFunctionFn() {
        allNews.style.backgroundColor = ' #f8f6f6';
        nextDomesticNews.style.backgroundColor = ' #f8f6f6';
        ForeignNews.style.backgroundColor = '#053755';
        nextDomesticNews.style.color = 'black';
        ForeignNews.style.color = 'white';
        allNews.style.color = 'black';
        mainInfo.style.display = "none";
        z.style.display = 'none';

        fn.style.display = "block";

    }
</script>













<script src="//ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jQuery.Marquee/1.5.0/jquery.marquee.min.js"></script>

