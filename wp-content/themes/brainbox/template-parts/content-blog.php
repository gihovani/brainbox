<?php
// get respective cases
$args			      = array(
  'post_type' 			=> 'post',
  'post_status'     => 'publish',
  'posts_per_page'  => 4,
);
$query		      = new WP_Query( $args );
if( $query->have_posts() ) {

  $array				= array();
  $i						= 0;
  while( $query->have_posts() ) : $query->the_post();

    // img
    $img              				= wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '550x550' );
    if( $img )								{ $img = $img[0]; }

    // cats
    $cats											= '';
    $catss 										= get_the_category( $post->ID );
    foreach($catss as $c) 		{ $cats .= '<a href="'.get_category_link($c->term_id).'">'.$c->name.'</a>, '; }
    $cats											= rtrim($cats, ', ');

    // date
    $date											= get_the_date();

    // results
    $array[$i]['title']				= get_the_title();
    $array[$i]['exc']				  = get_the_excerpt();
    $array[$i]['url']				  = get_the_permalink();
    $array[$i]['img']				  = $img;
    $array[$i]['cats']				= $cats;
    $array[$i]['date']				= $date;

    $i++;

  endwhile; wp_reset_postdata();
  //echo '<pre>'; print_r($array); exit();
?>

<!-- faixa noticias -->
<div class="faixa-noticias mt-5">
    <div class="container-xl">
        <div class="row faixa-noticias-grupo-3-container">
            <!-- coluna esquerda uma noticia grande -->
            <?php if( isset($array[0]) ) { ?>
            <div class="col-12 col-lg-6">
                <div class="card-noticia not-grande">
                    <a href="<?php echo $array[0]['url']; ?>">
                        <div class="card-noticia-img-wrapper"><img src="<?php echo $array[0]['img']; ?>"></div>
                    </a>
                    <a href="<?php echo $array[0]['url']; ?>" class="noticia-titulo"><?php echo $array[0]['title']; ?></a>
                    <div class="noticia-tag-data-container">
                        <?php echo $array[0]['cats']; ?>
                        <span class="data"><?php echo $array[0]['date']; ?></span>
                    </div>
                    <p class="noticia-texto"><?php echo $array[0]['exc']; ?></p>
                </div>
            </div>
            <?php } ?>
            <?php if( isset($array[1]) || isset($array[2]) || isset($array[3]) ) { ?>
            <!-- coluna direita 2 noticias medias 1 noticia pequena -->
            <div class="col-12 col-lg-6">
                <?php if( isset($array[1]) ) { ?>
                <div class="card-noticia not-media">
                    <div class="esq">
                        <a href="<?php echo $array[1]['url']; ?>">
                            <div class="card-noticia-img-wrapper"><img src="<?php echo $array[1]['img']; ?>"></div>
                        </a>
                    </div>
                    <div class="dir">
                        <a href="<?php echo $array[1]['url']; ?>" class="noticia-titulo"><?php echo $array[1]['title']; ?></a>
                        <div class="noticia-tag-data-container">
                            <?php echo $array[1]['cats']; ?>
                            <span class="data"><?php echo $array[1]['date']; ?></span>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php if( isset($array[2]) ) { ?>
                <div class="card-noticia not-media">
                    <div class="esq">
                        <a href="<?php echo $array[2]['url']; ?>">
                            <div class="card-noticia-img-wrapper"><img src="<?php echo $array[2]['img']; ?>"></div>
                        </a>
                    </div>
                    <div class="dir">
                        <a href="<?php echo $array[2]['url']; ?>" class="noticia-titulo"><?php echo $array[2]['title']; ?></a>
                        <div class="noticia-tag-data-container">
                            <?php echo $array[2]['cats']; ?>
                            <span class="data"><?php echo $array[2]['date']; ?></span>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php if( isset($array[3]) ) { ?>
                <div class="card-noticia not-pequena">
                    <a class="noticia-titulo" href="<?php echo $array[3]['url']; ?>"><?php echo $array[3]['title']; ?></a>
                    <div class="noticia-tag-data-container">
                        <?php echo $array[3]['cats']; ?>
                        <span class="data"><?php echo $array[3]['date']; ?></span>
                    </div>
                    <p class="noticia-texto"><?php echo $array[3]['exc']; ?></p>
                </div>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
        <!-- btn ver todas as noticias-->
        <div class="row">
            <div class="col-12 text-center text-18pt mt-3">
                <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" class="link-abre-area">ver todas as notícias no blog</a>
            </div>
        </div>
    </div>
</div>

<?php } ?>
