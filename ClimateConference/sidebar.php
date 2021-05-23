
<!-- Variables -->
<?php
$sidebar1 = get_field('sidebar1');
$sidebar2_icon = get_field('sidebar2_icon');
$sidebar2 = get_field('sidebar2');
$sidebar3_icon = get_field('sidebar3_icon');
$sidebar3 = get_field('sidebar3');
$sidebar4_icon = get_field('sidebar4_icon');
$sidebar4 = get_field('sidebar4');
$sidebar5_icon = get_field('sidebar5_icon');
$sidebar5 = get_field('sidebar5');
$sidebar6_icon = get_field('sidebar6_icon');
$sidebar6 = get_field('sidebar6');
$sidebar7_icon = get_field('sidebar7_icon');
$sidebar7 = get_field('sidebar7');
$sidebar8_icon = get_field('sidebar8_icon');
$sidebar8 = get_field('sidebar8');
$sidebar9_icon = get_field('sidebar9_icon');
$sidebar9 = get_field('sidebar9');
$sidebar10_icon = get_field('sidebar10_icon');
$sidebar10 = get_field('sidebar10');
$sidebar11_icon = get_field('sidebar11_icon');
$sidebar11 = get_field('sidebar11');
$sidebar12_icon = get_field('sidebar12_icon');
$sidebar12 = get_field('sidebar12');
$sidebar13_icon = get_field('sidebar13_icon');
$sidebar13 = get_field('sidebar13');
$sidebar14_icon = get_field('sidebar14_icon');
$sidebar14 = get_field('sidebar14');
?>

<!-- Sidebar -->
<div class="sidebar" style="margin-top: 18px">
        <nav class="sidebar_nav navbar-nav">
            <ul class="ul">
                 
                <?php if($sidebar1):?>
                <a class="nav-link active" href="" id="active_link" disabled><li class="sidebar_items nav-item"><span><img src="wp-content/themes/plaintext/site_images/earth_colour.jpg" class="earth_blue" style="background: none">&nbsp;</span><?php echo $sidebar1;?><span><img src="wp-content/themes/plaintext/site_images/earth_colour.jpg" class="earth_blue earth_blue_2" style="background: none">&nbsp;</span><span class="sr-only">(current)</span></li></a>
                <?php endif; ?>
                
                <?php if($sidebar2):?>
                <a class="nav-link" href="#"><li class="sidebar_items nav-item"><span class="bullets" style="float: left;"><?php echo $sidebar2_icon;?></span><?php echo $sidebar2;?></li></a>
                <?php endif; ?>
                
                <?php if($sidebar3):?>
                <a class="nav-link" href="#"><li class="sidebar_items nav-item"><span class="bullets" style="float: left;"><?php echo $sidebar3_icon;?></span><?php echo $sidebar3;?></li></a>
                <?php endif; ?>
                
                <?php if($sidebar4):?>
                <a class="nav-link" href="#"><li class="sidebar_items nav-item"><span class="bullets" style="float: left;"><?php echo $sidebar4_icon;?></span><?php echo $sidebar4;?></li></a>
                <?php endif; ?>
                
                <?php if($sidebar5):?>
                <a class="nav-link" href="#"><li class="sidebar_items nav-item"><span class="bullets" style="float: left;"><?php echo $sidebar5_icon;?></span><?php echo $sidebar5;?></li></a>
                <?php endif; ?>
                
                <?php if($sidebar6):?>
                <a class="nav-link" href="#"><li class="sidebar_items nav-item"><span class="bullets" style="float: left;"><?php echo $sidebar6_icon;?></span><?php echo $sidebar6;?></li></a>
                <?php endif; ?>
                
                <?php if($sidebar7):?>
                <a class="nav-link" href="#"><li class="sidebar_items nav-item"><span class="bullets" style="float: left;"><?php echo $sidebar7_icon;?></span><?php echo $sidebar7;?></li></a>
                <?php endif; ?>
                
                <?php if($sidebar8):?>
                <a class="nav-link" href="#"><li class="sidebar_items nav-item"><span class="bullets" style="float: left;"><?php echo $sidebar8_icon;?></span><?php echo $sidebar8;?></li></a>
                <?php endif; ?>
                
                <?php if($sidebar9):?>
                <a class="nav-link" href="#"><li class="sidebar_items nav-item"><span class="bullets" style="float: left;"><?php echo $sidebar9_icon;?></span><?php echo $sidebar9;?></li></a>
                <?php endif; ?>
                
                <?php if($sidebar10):?>
                <a class="nav-link" href="#"><li class="sidebar_items nav-item"><span class="bullets" style="float: left;"><?php echo $sidebar10_icon;?></span><?php echo $sidebar10;?></li></a>
                <?php endif; ?>
                
                <?php if($sidebar11):?>
                <a class="nav-link" href="#"><li class="sidebar_items nav-item"><span class="bullets" style="float: left;"><?php echo $sidebar11_icon;?></span><?php echo $sidebar11;?></li></a>
                <?php endif; ?>
                
                <?php if($sidebar12):?>
                <a class="nav-link" href="#"><li class="sidebar_items nav-item"><span class="bullets" style="float: left;"><?php echo $sidebar12_icon;?></span><?php echo $sidebar12;?></li></a>
                <?php endif; ?>
                
                <?php if($sidebar13):?>
                <a class="nav-link" href="#"><li class="sidebar_items nav-item"><span class="bullets" style="float: left;"><?php echo $sidebar13_icon;?></span><?php echo $sidebar13;?></li></a>
                <?php endif; ?>
                
                <?php if($sidebar14):?>
                <a class="nav-link" href="#"><li class="sidebar_items nav-item double"><span class="bullets bullets_double" style="float: left;"><?php echo $sidebar14_icon;?></span><?php echo $sidebar14;?></li></a>
                <?php endif; ?>

            </ul>
        </nav>
    </div>