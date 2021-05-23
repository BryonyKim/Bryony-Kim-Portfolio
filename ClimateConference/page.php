<?php get_header(); ?>

<!--Variables-->
    <!-- Sidebar -->
<?php
$sidebar1 = get_field('sidebar1');
?>
    <!-- Sub-heading 1 -->
<?php
$sub_heading1 = get_field('featured');
?>

    <!-- Sub-heading 2 -->
<?php
$sub_heading2 = get_field('most_popular');
?>

    <!-- Image 1 -->
<?php
$image1 = get_field('content');
$picture1 = $image1['sizes']['my_custom_size'];
$alt = $image1['alt'];
$title = $image1['title'];
$caption = $image1['caption'];
$description = $image1['description'];
?>

    <!-- Image 2 -->
<?php
$image2 = get_field('content_image_2');
$picture2 = $image2['sizes']['my_custom_size'];
$alt2 = $image2['alt'];
$title2 = $image2['title'];
$caption2 = $image2['caption'];
$description2 = $image2['description'];
?>

    <!-- Content section 2 -->
<?php
$content_section2 = get_field('content_section_2');
?>


    <!-- Main Page -->
    <div class="container-fluid">
         
        <div class="row">
            
                 <!-- Sidebar -->
                 <div class="col-4 sidebar_list">
                        <?php get_sidebar(); ?>
                 </div>
    
      
                 <div class="col-8">  

                        <!-- Sub-heading 1 -->
                        <?php if($sub_heading1):?>
                        <h2 class="sub_headings"><?php echo $sub_heading1;?></h2>
                        <?php endif; ?>


                        <!-- Featured Images -->
                        <div class="row content">

                             <!-- Display Image 1 -->
                             <?php if($image1):?>
                             <div class="col-6" style="background-size: cover; width: 100%">
                                   <img src="<?php echo $picture1;?>" class="img-fluid images" style="max-height:240px; width: 400px" alt="<?php echo $alt;?>" title="<?php echo $title;?>">
                                   <div class="image_text_box">
                                        <p class="image_text"><?php echo $caption;?></p>
                                   </div>    
                                   <p class="mb-0"><a href="#" class="image_links"><?php echo $description;?></a></p>
                             </div>
                             <?php endif; ?>

                             <!-- Display Image 2 -->
                             <?php if($image2):?>
                             <div class="col-6" style="background-size: cover; width:100%">
                                   <img src="<?php echo $picture2;?>" class="img-fluid images" style="max-height:240px; width: 400px" alt="<?php echo $alt2;?>" title="<?php echo $title2;?>">
                                   <div class="image_text_box">
                                        <p class="image_text"><?php echo $caption2;?></p>
                                   </div>    
                                   <p class="mb-0" style="clear: both; display: block"><a href="#" class="image_links"><?php echo $description2;?></a></p>
                             </div>
                             <?php endif; ?>

                        </div>


                        <!-- Sub-heading 2 -->
                        <?php if($sub_heading2):?>
                        <h2 class="sub_headings"><?php echo $sub_heading2;?></h2>
                        <?php endif; ?>

                        <!-- Display Content Section 2 -->
                        <?php if($content_section2):?>
                        <div class="col-12 m-0 p-0">
                                <div class="section2 content">
                                        <?php echo $content_section2;?>
                                </div>
                         </div>
                        <?php endif; ?>

                </div>

        </div>
    </div>

<?php get_footer(); ?>
