<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package brainbox
 */

?>



<!-- btn volta topo -->
<div class="volta-topo-container">
		<a href="#topo">
				<span>VOLTAR AO TOPO</span>
				<img src="<?php echo get_template_directory_uri(); ?>/images/icos/arrow-up.png">
		</a>
</div>
<!-- faixa-unidades -->
<div class="faixa-unidades py-md-4">
		<div class="container-xl py-3">
				<div class="row">
						<div class="col-12 col-md-5 pt-5">
								<?php if( $title = get_field('cf_fo_title1', 'options') ) { ?><p class="text-24pt"><b><?php echo $title; ?></b></p><?php } ?>
								<?php if( $add = get_field('cf_fo_add1', 'options') ) { ?>
								<div class="d-flex ms-3 mt-3">
										<div class="d-flex align-items-center"><img src="<?php echo get_template_directory_uri(); ?>/images/icos/location.png"></div>
										<p class="text-18pt text-cinza7 m-0 ms-3"><?php echo $add; ?></p>
								</div>
								<?php } ?>
								<?php if( $tel = get_field('cf_fo_tel1', 'options') ) { ?>
								<div class="d-flex ms-3 mt-3">
										<div class="d-flex align-items-center"><img src="<?php echo get_template_directory_uri(); ?>/images/icos/phone.png"></div>
										<p class="text-18pt text-cinza7 m-0 ms-3"><?php echo $tel; ?></p>
								</div>
								<?php } ?>
						</div>
						<div class="col-12 col-md-5 pt-5">
								<?php if( $title = get_field('cf_fo_title2', 'options') ) { ?><p class="text-24pt"><b><?php echo $title; ?></b></p><?php } ?>
								<?php if( $add = get_field('cf_fo_add2', 'options') ) { ?>
								<div class="d-flex ms-3 mt-3">
										<div class="d-flex align-items-center"><img src="<?php echo get_template_directory_uri(); ?>/images/icos/location.png"></div>
										<p class="text-18pt text-cinza7 m-0 ms-3"><?php echo $add; ?></p>
								</div>
								<?php } ?>
								<?php if( $tel = get_field('cf_fo_tel2', 'options') ) { ?>
								<div class="d-flex ms-3 mt-3">
										<div class="d-flex align-items-center"><img src="<?php echo get_template_directory_uri(); ?>/images/icos/phone.png"></div>
										<p class="text-18pt text-cinza7 m-0 ms-3"><?php echo $tel; ?></p>
								</div>
								<?php } ?>
						</div>
						<div class="col-12 col-md-2 pt-5">
								<div id="menus-footer" class="d-flex align-items-center d-md-block">
										<!-- ul menu primario -->
										<?php
										wp_nav_menu(
											array(
												'theme_location' 		=> 'menu-2',
												'menu_id'        		=> 'sec-menu',
												'container_class'   => 'menu-secundario',
											)
										);
										?>

										<!-- ul redes sociais -->
										<div class="menu-redes-sociais-secundario">
												<ul>
														<?php if( $url = get_field('cf_ms_link', 'options') ) { ?><li><a href="<?php echo $url; ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/icos/linkedin.png"></a></li><?php } ?>
														<?php if( $url = get_field('cf_ms_inst', 'options') ) { ?><li><a href="<?php echo $url; ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/icos/instagram.png"></a></li><?php } ?>
												</ul>
										</div>
								</div>
						</div>
				</div>
		</div>
</div>


<!-- faixa-grupo -->
<div class="faixa-grupo py-5">
		<div class="container-xl">
				<div class="row">
					<?php if( $img = get_field('cf_fo_logoom', 'options') ) { $img = $img['url']; ?>
						<div class="col-12 col-md-auto text-center text-md-start">
								<p><b>Somos parte do</b></p>
								<?php if( $url = get_field('cf_fo_logoom_link', 'options') ) : ?>
								<a href="<?php echo $url ?>" target="_blank" ?>
								<?php endif; ?>
									<img src="<?php echo $img; ?>">
								<?php if( $url = get_field('cf_fo_logoom_link', 'options') ) : ?>	
								</a>
								<?php endif; ?>
						</div>
					<?php } ?>
					<?php if( have_rows('cf_fo_ints', 'options') ) { ?>
						<div class="col-12 col-md text-center text-md-start ms-md-5">
								<p class="d-block"><b>também integram o grupo OM</b></p>
								<div class="d-flex flex-column flex-md-row flex-wrap justify-content-around">
									<?php while( have_rows('cf_fo_ints', 'options') ) : the_row(); $img = get_sub_field('cf_fo_ints_img'); 
																	$img = $img['url']; 
																	$url = get_sub_field('cf_fo_ints_link') ?>
										<div class="img-wrapper">
												<a href="<?php echo $url ?>" target="_blank"><img src="<?php echo $img; ?>"></a>
										</div>
									<?php endwhile; ?>
								</div>
						</div>
					<?php } ?>
				</div>
		</div>
</div>




</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
