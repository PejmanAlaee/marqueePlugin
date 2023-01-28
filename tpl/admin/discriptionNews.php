
<?php $txt =  get_post_meta($w->ID,'_hmci_news_discription')  ?>

<?php $link =  get_post_meta($w->ID,'_hmci_news_Link')  ?>
<?php $linkUrl =  get_post_meta($w->ID,'_hmci_news_Link_url')  ?>

<?php  if(!isset($txt[0]))  $txt[0] = "" ?>
<?php  if(!isset($link[0]))  $link[0] = "" ?>
<?php  if(!isset($linkUrl[0])) $linkUrl[0] = "" ?>

<div>
    <label for="linkShow" style="padding-right: 4px">منبع خبر</label>
      <div style="width: 100%">
         <input type="text" id="linkShow" name="linkShow" value="<?php echo $link[0] ?>" style="width: 46%">
      </div>
    <label for="linkUrl" style="padding-right: 4px">لینک خبر</label>
    <div style="width: 100%">
        <input type="text" id="linkUrl" name="linkUrl" value="<?php echo $linkUrl[0] ?>" style="width: 46%">
    </div>
    <label for="discriptionInputNews" style="padding-right: 4px">توضیحات</label>
       <div style="margin-top: 10px ; width: 100%">
         <textarea id="discriptionInputNews" name="discriptionInputNews" rows="4" cols="50"> <?php echo $txt[0] ?></textarea>
     </div>
</div>
