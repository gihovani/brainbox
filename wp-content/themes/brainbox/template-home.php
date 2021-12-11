<?php
/* Template name: Home */


get_header();
?>
<main id="primary" class="site-main">
	
<span style="display:none"><?php if(wp_is_mobile()) { echo "mobile"; }; ?></span>

	<?php while (have_posts()) : the_post(); ?>

		<!-- banner superior -->
		<?php if (have_rows('md_hm_bans')) { ?>
			<div id="home-banner-superior">
				<!-- carousel -->
				<div id="home-banner-superior-tns-carousel">
					
				
					<?php while (have_rows('md_hm_bans')) : the_row(); ?>
					
					<div>
					
					<?php
						if ($link = get_sub_field('md_hm_bans_link')) {

					?>
							<a href="<?php echo $link ?>">
							<?php
						}
						

							if (get_sub_field('md_hm_bans_media_type') == 'img') :

								if(wp_is_mobile()): 
									if(get_sub_field('md_hm_bans_img_mobile')) {
										$img = get_sub_field('md_hm_bans_img_mobile');
									} else {
										$img = get_sub_field('md_hm_bans_img');
									}
								?>
									<img src="<?php echo $img['sizes']['768x340']; ?>" data-exp-tipo="img" class="img-fluid">
								<?php else : 
									$img = get_sub_field('md_hm_bans_img');
									?>
									<img src="<?php echo $img['sizes']['1920x850']; ?>" data-exp-tipo="img" class="img-fluid">
								<?php endif; ?>
								
							<?php elseif(get_sub_field('md_hm_bans_vid')) : ?>
								<div class="embed-container">
									<video src="<?php echo get_sub_field('md_hm_bans_vid'); ?>" muted data-exp-tipo="vid" autoplay loop muted class="img-fluid"></video>
								</div>
							<?php endif; ?>

							<?php if ($link = get_sub_field('md_hm_bans_link')) { ?>
							</a>
						<?php } ?>
						
					</div>
						
					<?php endwhile; ?>
				</div>
				<!-- container para os buttons nav -->
				<div id="home-banner-superior-nav-container"></div>
			</div>
		<?php } ?>



		<!-- chamada - texto abaixo do banner -->
		<?php if ($text = get_field('md_hm_call')) { ?>
			<div id="home-faixa-chamada" class="mt-5">
				<div class="container-xl">
					<div class="row">
						<div class="col-12 px-5">
							<p><?php echo $text; ?></p>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>



		<?php
		if (have_rows('md_hm_cases')) {

			// get template cases page
			$template 		= get_pages_by_template('template-cases.php');

			while (have_rows('md_hm_cases')) : the_row();
				$obj						= get_sub_field('md_hm_cases_case');
				$obj_id					= $obj->term_id;
				$obj_name				= $obj->name;
				$obj_slug				= $obj->slug;
				$obj_tax				= $obj->taxonomy;
				$obj_link				= false;
				if ($template) {
					$obj_link = get_page_link($template[0]) . '?categoria=' . $obj_slug;
				}
				//echo '<pre>';print_r(get_sub_field('md_hm_cases_case'));echo '</pre>';
				//echo $obj_id.'<br />'.$obj_name.'<br />'.$obj_slug.'<br />'.$obj_tax.'<br />'.$obj_link;

				// get respective cases
				$args			      = array(
					'post_type' 			=> 'case',
					'post_status'     => 'publish',
					'posts_per_page'  => 3,
					'orderby' 				=> 'menu_order',
					'order' 					=> 'ASC',
					'tax_query'       => array(
						array(
							'taxonomy'    => $obj_tax,
							'field'       => 'slug',
							'terms'       => $obj_slug,
						),
					),
				);
				$query		      = new WP_Query($args);
				if ($query->have_posts()) {
		?>
					<!-- cases Consultoria Estratégica -->
					<div class="faixa-linha-cases mt-5">
						<div class="container-xl">
							<div class="row">
								<div class="col-12 faixa-linha-cases-title-container">
									<span class="titulo-area"><?php echo $obj_name; ?></span>
									<?php if ($obj_link) { ?><a href="<?php echo $obj_link; ?>" class="link-abre-area">ver todos</a><?php } ?>
								</div>
							</div>
							<div class="row mt-3">
								<?php
								while ($query->have_posts()) : $query->the_post();

									// image
									$img_src				 	= '';
									$img              = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), '356x200');
									if ($img) {
										$img_src = $img[0];
									}

									// tags
									$tags_html				= '';
									$tags 						= get_the_terms($post->ID, 'case-tag');
									if ($tags) {
										foreach ($tags as $tag) :
											$tags_html	.= '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>, ';
											//$tags_html	.= "{$tag->name}, ";
										endforeach;
										$tags_html		= rtrim($tags_html, ', ');
									}

								?>
									<div class="col-12 col-sm-4">
										<div class="card-case">
											<a href="<?php the_permalink(); ?>">
												<div class="card-case-img-wrapper">
													<img src="<?php echo $img_src; ?>">
												</div>
											</a>
											<p class="card-case-titulo"><?php the_title(); ?></p>
											<?php if ($tags) { ?><p class="card-case-tags"><?php echo $tags_html; ?></p><?php } ?>
										</div>
									</div>
								<?php endwhile;
								wp_reset_postdata(); ?>
							</div>
						</div>
					</div>
		<?php }
			endwhile;
		} ?>




		<!-- chamada experiencia comprovada -->
		<?php

        $logos = [];
        if (have_rows('md_hm_ex_logos')) {
            $i					= 0;
            while (have_rows('md_hm_ex_logos')) : the_row();
                $logos[$i]			= get_sub_field('md_hm_ex_logos_image');
                $i++;
            endwhile;
        }

//        print_r($logos);

        if (have_rows('md_hm_ex_exs')) {
			$i					= 0;
			$array			= array();
			while (have_rows('md_hm_ex_exs')) : the_row();

				$array[$i]['title']			= get_sub_field('md_hm_ex_exs_title');
				$array[$i]['items']			= array();
				if (have_rows('md_hm_ex_exs_its')) {
					while (have_rows('md_hm_ex_exs_its')) : the_row();
						$array[$i]['items'][]			= get_sub_field('md_hm_ex_exs_its_title');
					endwhile;
				}
				$i++;

			endwhile;

//            sort($array);
//			echo '<pre>';print_r($array); exit();
		?>
			<div id="home-faixa-experiencia" class="mt-5">
				<div class="container-xl my-5">
					<div class="row">
						<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 d-flex flex-column justify-content-center text-center text-md-start">
							<?php if ($title = get_field('md_hm_ex_title')) { ?><span class="titulo"><?php echo $title; ?></span><?php } ?>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 d-flex flex-column justify-content-center text-center text-md-start">
                            <?php if ($sub = get_field('md_hm_ex_text')) { ?><span class="texto"><?php echo $sub; ?></span><?php } ?>
                        </div>
                        
					</div>
				</div>
            </div>

            <div id="home-faixa-logos">
                <div class="container-xl mt-1">
                    <div class="row">
                        <?php foreach ($logos as $logo) : ?>
                        <div class="col-lg-4 col-sm-6 col-xs-12 text-center mx-auto p-5">
                            <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" />
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <div id="veja-mais" class="row p-5 text-center">
                        <p>Veja a lista completa de empresas que já atendemos »</p>
                    </div>
                </div>
            </div>


                <div id="home-faixa-lista" class="mt-1" style="display: none">
                    <div class="container-lista mb-5">
                        <div class="row">
                            <div id="home-faixa-experiencia-nav-container" class="col-12 d-flex flex-column flex-sm-row">
                                <?php foreach ($array as $ar) : ?>
                                    <div class="item"><?php echo $ar['title']; ?></div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 offset-2 mt-5">
                                <div id="home-faixa-experiencia-tns-carousel">
                                    <?php foreach ($array as $ar) : ?>
                                    <div class="d-inline-flex flex-wrap">
                                        <div class="col-12 col-sm-3 text-left p-3 list-companies">

                                            <?php
                                                $totalItems = count($ar['items']);
                                                $itemsColumn = intdiv($totalItems, 3);
                                                $itemsFirstColumn = $itemsColumn + $totalItems % 3;
                                                $i = 0;
                                                $currCol = 0;
                                            ?>

                                            <?php foreach ($ar['items'] as $it) :
                                                $i++; ?>

                                                <?php $firstCharacter = $it[0]; ?>
                                                <?php if( isset($section) and $section == $firstCharacter) : ?>

                                                <?php else : ?>
                                                    <?php $margin = ""; if($i == 1) { $margin = "margin-top: 0 !important"; }; ?>
                                                    <h5 style="<?php echo $margin; ?>; text-align:left;"><?php $section = $firstCharacter; echo $section; ?></h5>
                                                <?php endif; ?>

                                                <p style="text-align:left;"><?php echo $it; ?></p>
                                                <?php
                                                if ($i == $itemsFirstColumn) :
                                                $itemsFirstColumn = $itemsColumn;
                                                $i = 0;
                                                ?>
                                        </div>

                                        <?php if ($currCol < 2) :
                                        $currCol++;
                                        ?>
                                        <div class="col-12 col-sm-3 text-left p-3 list-companies">

                                            <?php
                                            endif;
                                            endif;
                                            endforeach;
                                            ?>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

			<?php } ?>










		<?php endwhile; ?>


		<?php get_template_part('template-parts/content', 'blog'); ?>

		<?php get_template_part('template-parts/content', 'newsletter'); ?>


</main>
<?php
get_footer();
