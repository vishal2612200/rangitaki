<!-- The following code displays the social buttons -->

<?php
    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>

<div class="socialbar">
    <!--Twitter-->
    <a href="https://twitter.com/intent/tweet?text=Check out: <?php echo $post->title; ?> &url=<?php echo $url; ?>&original_referer=" target="blank"><img src="res/img/twttr.svg" class="socialimg"/></a>
    <!--Google+-->
    <a href="https://plus.google.com/share?url=<?php echo $url; ?>&hl=en-US" target="blank"><img src="res/img/gplus.svg" class="socialimg" /></a>
    <!--Facebook-->
    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>&t=<?php echo $post->title; ?>" target="blank"><img src="res/img/fb.png" class="socialimg" /></a>
</div>