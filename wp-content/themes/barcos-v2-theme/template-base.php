<?php 
    //Restrições de acesso
    //somente_logado(); 
    //somente_admin();
?>
<?php /* Template Name: Barco Modelo */ get_header(); ?>
<?php if ( have_posts() ) {	while ( have_posts() ) { the_post(); ?>

<div class='section menu-fixo'>
    <div class='container'>
        <div class="layout-flex aic jcsb">
            <div class="coluna-3 enquire">
                <span><?php the_field('enquire_label') ?></span>
                <span><?php the_field('telephone') ?></span>
            </div>

            <div class="coluna-7 menu">
                <a href="#capa"><?php the_field('yatch_label') ?></a>
                <a href="#details"><?php the_field('details_label') ?></a>
                <a href="#gallery"><?php the_field('gallery_label') ?></a>
                <a href="#contact"><?php the_field('contact_label') ?></a>
                <?php if (get_field('alternate_link')) { ?>
                    <a class="flag" href="<?php the_field('alternate_link'); ?>">                    
                        <img src="https://www.countryflags.io/<?php the_field('alternate_language'); ?>/flat/64.png" alt="">
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<div class='section barco-capa'>
    <div class='container'>
        <div class="layout-flex aife jcfe">
            <div class="layout-flex layout-titulo aic jcsb">
                <h1><?php the_field('title') ?></h1>

                <?php if (get_field('logo')) { ?>
                    <img class="logo" src="<?php the_field('logo') ?>" alt="">
                <?php } ?>
            </div>
           
             
        </div>    
    </div>
    <div class="container-slides">
        <div class="slick-slides-capa">
        <?php foreach( get_field('main_gallery') as $cada) { ?> 
            <div class="slide-capa" style="background-image: url(<?php echo $cada ?>);"></div>
        <?php } ?>
        </div>
    </div>
    <a href="" class="nav-prev-capa">
        <i class="fa fa-angle-left" aria-hidden="true"></i>
    </a>
    <a href="" class="nav-next-capa">
        <i class="fa fa-angle-right" aria-hidden="true"></i>
    </a>
</div>

<div class='section barco-icones' id="capa">
    <div class='container'>
        <div class="layout-flex aifs jcc">
            <div class="coluna-2 bloco-imagem icone-barco">
                <img src='<?php echo get_template_directory_uri(); ?>/img/icone-info-1@2x.png' alt=''>
                <h3><strong><?php the_field('label_feature_1') ?></strong><br><?php the_field('feature_1') ?></h3>
            </div>
            <div class="coluna-2 bloco-imagem icone-barco">
                <img src='<?php echo get_template_directory_uri(); ?>/img/icone-info-2@2x.png' alt=''>
                <h3><strong><?php the_field('label_feature_2') ?></strong><br><?php the_field('feature_2') ?></h3>
            </div>
            <div class="coluna-2 bloco-imagem icone-barco">
                <img src='<?php echo get_template_directory_uri(); ?>/img/icone-info-3@2x.png' alt=''>
                <h3><strong><?php the_field('label_feature_3') ?></strong><br><?php the_field('feature_3') ?></h3>
            </div>
            <div class="coluna-2 bloco-imagem icone-barco">
                <img src='<?php echo get_template_directory_uri(); ?>/img/icone-info-4@2x.png' alt=''>
                <h3><strong><?php the_field('label_feature_4') ?></strong><br><?php the_field('feature_4') ?></h3>
            </div>
        </div>
    </div>
</div>

<div class='section barco-seemore' id="details">
    <div class='container'>
        <div class="bloco-texto coluna-6">
            <h2><?php the_field('title_yacht') ?></h2>
            <?php the_field('text_yacht') ?>
            <a href="" class="botao js-see-more more"><?php the_field('button_yacht') ?></a>
            <a href="" class="botao js-see-more less"><?php the_field('button_yacht_less') ?></a>
        </div>
    </div>
</div>

<div class='section barco-information' id="see-more">
    <div class='container'>
        <div class="layout-flex aifs jcsb">
            <div class="coluna-5 bloco-info">
                <h3><?php the_field('key_features_label') ?></h3>
                <p><?php the_field('key_features') ?></p>
            </div>
            <div class="coluna-7 bloco-info">
                <h3><?php the_field('rates_label') ?></h3>
                <div class="colunas-interna">
                <?php 
                    $bloco = get_field('rates');
                    foreach ( array_chunk($bloco, ceil(count($bloco)/2)) as $pedaco) { 
                ?> 
                    <div class="coluna-meio">
                    <?php foreach( $pedaco as $cada) { ?> 
                        <div class="item-col">
                            <small><?php echo $cada['title'] ?></small>
                            <span><?php echo $cada['description'] ?></span>
                        </div>
                    <?php } ?>
                    </div>
                <?php } ?>
                </div>
            </div>
            <div class="divisoria"></div>
            <div class="coluna-12 bloco-info">
                <h3><?php the_field('specification_label') ?></h3>

                <div class="colunas-interna sb">

                    <div class="colunas-interna coluna-5">
                    <?php 
                        $bloco = array_reverse(get_field('specification_numbers'));
                        foreach ( array_reverse(array_chunk($bloco, ceil(count($bloco)/2))) as $pedaco) { 
                    ?> 
                        <div class="coluna-meio">
                        <?php foreach( array_reverse($pedaco) as $cada) { ?> 
                            <div class="item-col">
                                <small><?php echo $cada['title'] ?></small>
                                <span><?php echo $cada['description'] ?></span>
                            </div>
                        <?php } ?>
                        </div>
                    <?php } ?>
                    </div>

                    <div class="colunas-interna coluna-7">
                        <div class="coluna-meio">
                        <?php foreach( get_field('specification_text') as $cada) { ?>
                        
                            <div class="item-col">
                                <small><?php echo $cada['title'] ?></small>
                                <span><?php echo $cada['description'] ?></span>
                            </div>
                        <?php } ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class='section barco-galerias' id="gallery">
    <div class='container'>
        <div class="layout-flex aifs jcsb">
            <div class="coluna-6">
                <?php $exterior_gallery = get_field('exterior_gallery') ?: array(get_template_directory_uri().'/img/fundo-yacht@2x-80.jpg'); ?>
                <a href="<?php echo $exterior_gallery[0] ?>" data-lightbox="exterior_gallery" class="gal-chamada" style="background-image: url(<?php echo $exterior_gallery[0] ?>);">
                    <div class="inside-gal">
                        <h3><?php the_field('title_exterior_gallery') ?></h3>
                        
                    </div>
                </a>
                <?php foreach( array_slice($exterior_gallery, 1) as $cada) { ?> 
                    <a class="hide" href="<?php echo $cada ?>" data-lightbox="exterior_gallery"></a>
                <?php } ?>
            </div>
            

            <div class="coluna-6">
                <?php $interior_gallery = get_field('interior_gallery') ?: array(get_template_directory_uri().'/img/fundo-yacht@2x-80.jpg'); ?>
                <a href="<?php echo $interior_gallery[0] ?>" data-lightbox="interior_gallery" class="gal-chamada" style="background-image: url(<?php echo $interior_gallery[0] ?>);">
                    <div class="inside-gal">
                        <h3><?php the_field('title_interior_gallery') ?></h3>
                    </div>                    
                </a>
                <?php foreach( array_slice($interior_gallery, 1) as $cada) { ?> 
                    <a class="hide" href="<?php echo $cada ?>" data-lightbox="interior_gallery"></a>
                <?php } ?>              
            </div>

            <div class="coluna-12" style="display:none !important;">
                <a href="<?php the_field('link_destinations') ?>" class="gal-chamada grandao" style="background-image: url(<?php the_field('photo_destinations')?:(get_template_directory_uri().'/img/fundo-yacht@2x-80.jpg') ?>);">
                    <div class="inside-gal">
                        <h3><?php the_field('title_destinations') ?></h3>
                    </div>                    
                </a>                
            </div>
        </div>
    </div>
</div>

<div class='section barcos-touch' id="contact">
    <div class='container'>
        <div class="in-touch">
            <div class="titulo">
                <h3><?php the_field('title_contact') ?></h3>
            </div>
            <?php echo do_shortcode(get_field('shortcode_contact')); ?>
            <div class="layout-flex aifs jcsb">
                <!--
                <?php the_field('email_contact') ?>
                <?php the_field('website_contact') ?>
                <?php the_field('telephone_contact') ?>
                -->
            </div> 
            <div class="regua-info">
                <span><?php the_field('email_contact') ?></span>
                <span>|</span>
                <?php the_field('website_contact') ?>
                <span>|</span>
                <?php the_field('telephone_contact') ?>
            </div>
        </div>   
    </div>
</div>


<?php } } ?>
<?php get_footer(); ?>