<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
	<link rel="pingback" href=" <?php bloginfo( 'pingback_url' ); ?>" >
	<?php wp_head(); ?>
    <link href="style.css" rel="stylesheet">
        <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    
</head>
<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
       
    
	<header class="site_header col-12" id="main_header">        
		<div class="wrapper clearfix">

               
 <!-- Variables -->
 <?php $title = get_field('title');?>
 <?php $menu1 = get_field('menu_bar_1');?>
 <?php $menu2 = get_field('menu_bar_2');?>
 <?php $menu3 = get_field('menu_bar_3');?>
 <?php $menu4 = get_field('menu_bar_4');?>
 <?php $menu5 = get_field('menu_bar_5');?>
 <?php $menu6 = get_field('menu_bar_6');?>
 <?php $tagline1 = get_field('tagline_1');?>
 <?php $tagline2 = get_field('tagline_2');?>
            
      
            <div class="menu_bar">

                   <nav role="navigation" class="navbar navbar-expand-lg fixed-top navbar-light d-flex" style="z-index: 3">
                       
                            <div class="container-fluid nav_container">

                                    <!-- Title -->
                                    <h1 class="title"><?php echo $title;?></h1> 

                                    <!-- Menu Button -->
                                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>

                                    <!-- Navbar -->
                                    <div class="collapse navbar-collapse menu" id="menu">
                                        <ul class="navbar-nav flex-grow-1 justify-content-end flex-row">
                                            
                                            <?php if($menu1):?>
                                            <li class="nav-item menu_items"><a class="nav-link active menu_home" href=""><span><img src="wp-content/themes/plaintext/site_images/earth_colour.jpg" class="home_earth"></span><?php echo $menu1;?></a></li>
                                            <?php endif; ?>
                                            
                                            <?php if($menu2):?>
                                            <li class="nav-item menu_items"><a class="nav-link" href=""><?php echo $menu2;?></a></li>
                                            <?php endif; ?>
                                            
                                            <?php if($menu3):?>
                                            <li class="nav-item menu_items"><a class="nav-link" href=""><?php echo $menu3;?></a></li>
                                            <?php endif; ?>
                                            
                                            <?php if($menu4):?>
                                            <li class="nav-item menu_items menu_buttons"><a class="nav-link" href=""><?php echo $menu4;?></a></li>
                                            <?php endif; ?>
                                            
                                            <?php if($menu5):?>
                                            <li class="nav-item menu_items menu_buttons"><a class="nav-link" href=""><?php echo $menu5;?></a></li>
                                            <?php endif; ?>
                                            
                                            <?php if($menu6):?>
                                            <li class="nav-item menu_items menu_buttons"><a class="nav-link" href=""><?php echo $menu6;?></a></li>
                                            <?php endif; ?>
                                            
                                        </ul>
                                    </div>
                            </div>
                    </nav>
            </div>
            
            <div class="container-fluid header_container">    
                    <div class="tagline_section col-12">
                            <hr class="hr">
                            <div class="col-12">
                                <p class="taglines"><?php echo $tagline1;?></p>
                            </div>
                            <hr class="hr">
                            <div class="col-12">
                                <p class="taglines"><?php echo $tagline2;?></p>
                            </div>
                            <hr class="hr">
                    </div>
            </div>         
			
		</div>			
	</header>				
