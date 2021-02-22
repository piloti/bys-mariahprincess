<?php get_header(); ?>
<?php if ( have_posts() ) {	while ( have_posts() ) { the_post(); ?>

<?php
    $programa = get_programa($post->ID);
    //prettyPrint($programa);
?>
<div class='section section-programa-capa'>
    <div class='container'>

        <div class="progcapa">
            
            <div class="progcapa__capa" style="background-image: url(<?php echo $programa['capa']; ?>;">
                <div class="proginfo">
                    <small class="ui-info"><?php echo $programa['tema']; ?></small>
                    <h2 class="titulo-item branco psingle"><?php echo $programa['nome']; ?></h2>
                    <div class="ui-info data"><?php echo $programa['data_texto']; ?></div>
                </div>
            </div>    
            <div class="progcapa__controles">                
                <a href="" class="js-chama-player" data-alvo="<?php echo $post->ID; ?>"><i class="fa fa-play" aria-hidden="true"></i></a>
                <small class="progcapa__tempo"><?php echo $programa['duracao']; ?></small>
            </div>
        </div>   

    </div>
</div>

<div class='section section-programa-conteudo'>
    <div class='container'>
        <div class="programa-conteudo">
            <div class="informacao">
                <div class="bloco-texto">
                    <?php echo $programa['descricao']; ?>
                </div>

                <div class="bloco-texto ingles">
                    <?php echo $programa['descricao_ingles']; ?>
                </div>
            </div>
            <div class="playlist">
                <h3>Nesse programa</h3>
                <div class="bloco-texto">
                    <ul>
                    <?php foreach($programa['playlist'] as $musica) { ?>
                    <li><span><?php echo $musica['musica']; ?></span> <small><?php echo $musica['interprete']; ?></small></li>
                    <?php } ?>
                    </ul>
                </div>
            </div>
            <ul class="botoes">
                <a href="" class="mais prog fill-amarelo">
                    <?php get_template_part("img/svg","share"); ?>
                    <span>compartilhar</span>                    
                </a>
                <a href="" class="mais prog fill-amarelo">
                    <?php get_template_part("img/svg","download"); ?>
                    <span>download</span>                    
                </a>
            </ul>
        </div>
    </div>
</div>

<div class='section home-essenciais'>
    <div class='container'>
        <h2 class="titulo amarelo mb45">Ouça mais programas</h2>

        <ul class="essenciais__programas">
            
            <li class="essenciais__programa proginfo dark tema-amarelo">
                <div class="capa" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/tocar-icone-1@2x.png);"></div>
                <span class="ui-info topo">essa é pra tocar no rádio</span>
                <h2 class="titulo-card">Playlist de Liliana Onozato<h2>
                <div class="ui-info data">15.15.19</div>
                <a href="" class="mais amarelo fill-amarelo">
                    <span>ouvir</span>
                    <?php get_template_part("img/svg","seta"); ?>
                </a>
            </li>

            <li class="essenciais__programa proginfo dark tema-vermelho">
                <div class="capa" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/leitura-icone-1@2x.png);"></div>
                <span class="ui-info topo">leitura musicada</span>
                <h2 class="titulo-card">Raphael Rabello, Violão em Erupção</h2>
                <div class="ui-info data">15.15.19</div>
                <a href="" class="mais amarelo fill-amarelo">
                    <span>ouvir</span>
                    <?php get_template_part("img/svg","seta"); ?>
                </a>
            </li>

            <li class="essenciais__programa proginfo dark tema-bege">
                <div class="capa" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/brinstru-icone-1@2x.png);"></div>
                <span class="ui-info topo">brasil instrumental</span>
                <h2 class="titulo-card">Valsas <br><strong>Brasileiras</strong></h2>
                <div class="ui-info data">15.15.19</div>
                <a href="" class="mais amarelo fill-amarelo">
                    <span>ouvir</span>
                    <?php get_template_part("img/svg","seta"); ?>
                </a>
            </li>

            <li class="essenciais__programa proginfo dark tema-amarelodark">
                <div class="capa" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/anda-icone-1@2x.png);"></div>
                <span class="ui-info topo">o que zuim anda ouvindo</span>
                <h2 class="titulo-card">Reprise Zélia Duncan</h2>
                <div class="ui-info data">15.15.19</div>
                <a href="" class="mais amarelo fill-amarelo">
                    <span>ouvir</span>
                    <?php get_template_part("img/svg","seta"); ?>
                </a>
            </li>
        </ul>

        <div class="bloco-mais marginbig">
            <a href="" class="mais branco fill-branco">
                <span>Conheça o acervo completo</span>
                <?php get_template_part("img/svg","seta"); ?>
            </a>
        </div>

    </div>
</div>

<?php } } ?>
<?php get_footer(); ?>