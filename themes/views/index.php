<?php 
    $qr_works = $this->getVar('featured_set_works_as_search_result');
    $qr_entities = $this->getVar('featured_set_entities_as_search_result');
    $qr_exhibitions = $this->getVar('featured_set_exhibitions_as_search_result');
    $qr_exhibitions1 = $this->getVar('featured_set_exhibitions_ids'); 

    $vs_author_template =    "<unit relativeTo='ca_entities' excludeRelationshipTypes='doador' restrictToTypes='Artista'>".
                                "^ca_entities.preferred_labels.displayname".
                            "</unit>";

    $vs_media_template = "^ca_object_representations.media.large"; 

    $vs_artist_title = "^ca_entities.preferred_labels.displayname"; 

    $vs_artist_content = " 
                        <ifdef code='ca_entities.DadosBiograficos.AnoNascimento'>
                                ☼ ^ca_entities.DadosBiograficos.AnoNascimento</ifdef>
                        </ifdef>
                        <ifdef code='ca_entities.DadosBiograficos.AnoMorte'>
                                - † ^ca_entities.DadosBiograficos.AnoMorte</ifdef>
                        </ifdef>";
    
    $vs_work_template = "<a class='hexagono' href='#'>".
                        "<div class='hexagono-content'>".                            
                            $vs_media_template.           
                            "<h1> $vs_author_template </h1>".
                            "<p> ^ca_objects.preferred_labels.name </p>".           
                        "</div>".
                    "</a>";

    $vs_artist_template = " <h3> $vs_artist_title </h3>
                            <p> $vs_artist_content </p>";
    
?>


    


    <div class="row" style="padding-left:50px">
        <h1> Algumas Obras em Destaque </h1>
            
	    <div class="col-sm-5 " style='border-right:1px solid #ddd;'>
            <div>
            
                <p>A continuación, se presenta una selección de imágenes destacadas del acervo del Museu de Arte Contemporânea da Universidade de São Paulo (MAC USP). Este museo alberga una de las colecciones de arte moderno y contemporáneo más importantes de América Latina, con obras que abarcan diversas corrientes, técnicas y autores significativos del panorama artístico brasileño e internacional.
                </p>
                <p>Las imágenes que se muestran a continuación ofrecen una ventana a la riqueza y diversidad de esta colección. Podremos apreciar ejemplos de pintura, escultura, fotografía, grabado y otras expresiones artísticas que reflejan la evolución del arte a lo largo del siglo XX y XXI.

                </p>
                <p>Cada imagen nos invita a explorar diferentes lenguajes visuales, conceptualizaciones y diálogos con el contexto social, político y cultural de su tiempo. Desde abstracciones geométricas y líricas hasta representaciones figurativas y conceptuales, estas obras testimonian la vitalidad y la multiplicidad de la creación artística.

                </p>
                <p>A través de esta presentación, esperamos despertar la curiosidad y el interés por conocer más sobre el MAC USP y su valioso patrimonio artístico, que constituye una fuente inagotable de conocimiento y disfrute estético. Les invitamos a sumergirse en este universo de formas, colores e ideas que nos ofrecen estas imágenes.
                </p>
            </div>
        </div>
        <div class="col-sm-7" >
            <div class='mc-panal'>
            <?php 
                if($qr_works && $qr_works->numHits()){

                    while($qr_works->nextHit()){
                        //print_r($qr_res);
                        if($vs_media = $qr_works->getWithTemplate($vs_media_template, array("checkAccess" => $va_access_values))){
                            //$vs_caption = $qr_res->getWithTemplate($vs_caption_template);
                            //$vs_author = $qr_res->getWithTemplate($vs_author_template);
                            
                            $vs_caption = $qr_works->getWithTemplate($vs_work_template);
                            
                            print $vs_caption;
                            
                        }
                    }
                }
            ?>

            </div>

            <div class="click"><?php print caNavLink($this->request, _t("Ver todas as obras "), "click", "acervo", "Artists", "List")?></div>

            
        </div><!-- end col -->
        </div><!-- end row -->


<br><br><br><br>
    







































<div class="row" style="padding-left:50px">
    <h1> Alguns Artistas Em Destaque </h1>
    <div class="col-sm-5 " style='border-right:1px solid #ddd;'>
        <div>
            
            <p> O acervo do MAC USP também conta com importantes obras de artistas internacionais de diversas correntes, como o Cubismo (Albert Gleizes, Georges Braque), o Surrealismo (Marc Chagall, Max Ernst), a Arte Metafísica (Giorgio de Chirico) e muitos outros.
            </p>
            <p>
        Além dos nomes consagrados, o MAC USP também se dedica a apresentar e valorizar a produção de artistas emergentes e a diversidade da arte contemporânea, como demonstrado em iniciativas recentes como a incorporação de NFTs ao seu acervo com artistas como Gustavo Von Ha e as mostras do "Panorama da Arte Brasileira".
            </p><p>
        Para ter uma visão mais completa dos artistas em destaque, recomendo acompanhar as exposições temporárias e a programação do MAC USP, bem como explorar o seu acervo online. Cada visita e pesquisa podem revelar novas perspectivas sobre os inúmeros talentos representados no museu.
            </p>
        </div>
    </div>
    <div class="col-sm-7 ">
        <div class='mc-panal'>
        <?php 
            if($qr_entities && $qr_entities->numHits()){

                while($qr_entities->nextHit()){
                    //print_r($qr_res);
                    if(1 == 1){
                        //$vs_caption = $qr_res->getWithTemplate($vs_caption_template);
                        //$vs_author = $qr_res->getWithTemplate($vs_author_template);
                        
                        //$vs_caption = $qr_entities->getWithTemplate('<l>^ca_entities.preferred_labels.displayname  ^ca_entities.rank </l>');
                        //$vs_caption = $qr_entities->getWithTemplate('^ca_object_representations.media.icon');
                        //$vs_caption = $qr_entities->getWithTemplate('^ca_entities');
                        //$vs_caption = $qr_entities->getWithTemplate('^ca_object_representations');
                        

                        //print_r($qr_entities);

                        $idno = $qr_entities->getWithTemplate("^ca_entities.rank");
                        
                        $vs_content = $qr_entities->getWithTemplate($vs_artist_template);
                        $vs_item = caNavLink($this->request, $vs_content, "triangle", "artists", "ArtistsData", "artist/".$idno);

                        //print $vs_content.$idno; 
                        print $vs_item; 

                        


                    }
                }
            }
        ?>
        
        </div>

        <div class="click"><?php print caNavLink($this->request, _t("Ver todos los artistas "), "click", "artists", "ArtistsList", "index")?></div>

    </div> 
</div>



<br><br><br><br>
    
    
















































<div class="row" style="padding-left:50px">
    <h1> Algumas Exposições em Destaque: </h1>
    <div class="col-sm-4 " style='border-right:1px solid #ddd;'>
        <div> 
            <p>Mergulhe no universo da arte contemporânea explorando as diversas e instigantes exposições que o Museu de Arte Contemporânea da Universidade de São Paulo (MAC USP) oferece atualmente. De revisitações históricas a experimentações conceituais, o museu se apresenta como um espaço dinâmico para o encontro com a criação artística. A seguir, destacamos algumas das mostras imperdíveis que aguardam sua visita:
            </p>
        </div>
    <?php //print_r($qr_exhibitions1); ?>
    <?php //print_r($qr_exhibitions); ?>
    </div>  
    <div class="col-sm-8 ">
        <div class='mc-panal'>
                <?php 
                    if($qr_exhibitions && $qr_exhibitions->numHits()){

                        while($qr_exhibitions->nextHit()){
                            //print_r($qr_res);
                            if($vs_media = $qr_exhibitions->getWithTemplate($vs_media_template, array("checkAccess" => $va_access_values)) or True ){
                                //$vs_caption = $qr_res->getWithTemplate($vs_caption_template);
                                //$vs_author = $qr_res->getWithTemplate($vs_author_template);
                                
                                $vs_caption = $qr_exhibitions->getWithTemplate("^ca_occurrences.preferred_labels <br> ");
                                
                                print $vs_caption;
                                
                            
                            }
                        }
                    }
                ?>
                <div class='inProcess'></div>

        </div>
        <div class="click"><?php print caNavLink($this->request, _t("Ver as exposições "), "click", "exhibtions", "ExhibitionsList", "index")?></div>
     </div>
    
                    
    
</div>












































    


<script type='text/javascript'>
	$('#subtitle').html("");     
</script>



