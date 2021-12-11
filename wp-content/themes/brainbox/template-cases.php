<?php
/* Template name: Cases */



// parameter get
$categoria			= '';
if( isset($_GET['categoria']) && !empty( $_GET['categoria'] ) ) {
	$categoria		= $_GET['categoria'];
}



// get all cats
$a_cats			  	= array(
	'taxonomy' 		=> 'categoria',
	'hide_empty' 	=> true,
	'parent' 		=> 0,
	'orderby' 		=> 'meta_value_num',
  	'order'			=> 'DESC',
  	'meta_query' 	=> array(
    'relation' 		=> 'OR',
    array(
      		'key'		=> 'case_order',
			'compare'	=> 'NOT EXISTS'
    		),
    		array(
      			'key' 		=> 'case_order',
      			'value' 	=> 0,
      			'compare' 	=> '>='
    )
  ),
);
$cats			  		= get_terms( $a_cats );      	// get all tipo
//echo '<pre>';print_r($cats); exit();


// get all cases
$args			      		= array(
	'post_type' 			=> 'case',
	'post_status'     		=> 'publish',
	'posts_per_page'  		=> -1,
	'orderby' 				=> array('menu_order' => 'DESC', 'date' => 'DESC'),
	//'paged'           	=> $paged,
	//'post__in'			=> $ids,
	//'orderby' 			=> 'title',
	//'order' 				=> 'ASC',
);
$query		      = new WP_Query( $args );



// check if parameter has the right value
if( $cats && !empty($categoria) ) {
	$found			= false;
	foreach( $cats as $c ) :
		if( $c->slug == $categoria ) { $found = true; break; }
	endforeach;
	if( !$found ) { $categoria = ''; }
}



get_header();
?>
	<main id="primary" class="site-main">

		<?php while ( have_posts() ) : the_post(); ?>


      <!-- cases Consultoria Estratégica -->
			<?php if( $cats ) { ?>
      <div id="cases-faixa-filtro">
          <div class="container-xl">
              <div class="row mt-5 border-bottom border-cinza2">
                  <div class="col-6 col-md-8 ul-tags-container">
                      <ul>
                          <li><a href="*"<?php if( empty($categoria) ) { ?> class="ativo"<?php } ?>>Todos</a></li>
													<?php foreach( $cats as $c ) : ?>
													<li><a href="<?php echo $c->slug; ?>"<?php if( $categoria == $c->slug ) { ?> class="ativo"<?php } ?>><?php echo $c->name; ?></a></li>
													<?php endforeach; ?>
                      </ul>
                  </div>
                  <div class="col-6 col-md-4 d-flex justify-content-end">
                      <input id="cases-faixa-filtro-input-search" type="text" />
                      <div class="ms-2"><a id="cases-faixa-filtro-btn-lupa" href="*"><img src="<?php echo get_template_directory_uri(); ?>/images/icos/ico-search.png"></a></div>
                  </div>
              </div>
          </div>
      </div>
			<?php } ?>

			<?php if( $query->have_posts() ) { ?>
      <div id="cases-faixa-cases" class="mt-3" data-explay-filter-pesquisa="" data-explay-filter-tag="">
          <div class="container-xl">
              <div class="row justify-content-left">
									<?php
									while( $query->have_posts() ) : $query->the_post();

										// image
										$img_src				 	= '';
										$img              = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '356x200' );
										if( $img )				{ $img_src = $img[0]; }

										// cats
										$filter_html			= '';
										$cats							= get_the_terms( $post->ID, 'categoria' );
										if( $cats ) {
											foreach( $cats as $cat ) :
												$filter_html	.= $cat->slug.' ';
											endforeach;
											$filter_html		= rtrim( $filter_html, ' ' );
										}

										// tags
										$tags_html				= '';
										$tags_css				= '';
										$tags 						= get_the_terms( $post->ID, 'case-tag' );
										if( $tags ) {
											foreach( $tags as $tag ) :
												$tags_html	.= '<a href="'.get_tag_link($tag->term_id).'">'.$tag->name.'</a>, ';
												$tags_css	.= "{$tag->name} ";
											endforeach;
											$tags_html		= rtrim( $tags_html, ', ' );
										}

									?>
                  <div class="col-12 col-sm-4 case-container <?php echo $filter_html; ?>">
                      <div class="card-case">
                          <a href="<?php the_permalink(); ?>">
                              <div class="card-case-img-wrapper">
                                  <img src="<?php echo $img_src; ?>">
                              </div>
                          </a>
                          <span class="card-case-titulo"><?php the_title(); ?></span>
						  <span class="card-case-tags-text" style="display: none"><?php echo $tags_css; ?></span>
													<?php if( $tags ) { ?><p class="card-case-tags"><?php echo $tags_html; ?></p><?php } ?>
                      </div>
                  </div>
									<?php endwhile; wp_reset_postdata(); ?>
              </div>
          </div>
      </div>
			<?php } ?>


		<?php endwhile; ?>



		<?php get_template_part( 'template-parts/content', 'newsletter' ); ?>

	</main>
<?php
get_footer();
