<?php 
    $qr_works = $this->getVar('featured_set_works_as_search_result');
    $qr_entities = $this->getVar('featured_set_entities_as_search_result');
    $qr_exhibitions = $this->getVar('featured_set_exhibitions_as_search_result');


    $qr_exhibitions1 = $this->getVar('featured_set_exhibitions_ids'); 

    $vs_author_template =    "<unit relativeTo='ca_entities' excludeRelationshipTypes='doador' restrictToTypes='Artista'>".
                                "^ca_entities.preferred_labels.displayname".
                            "</unit>";
    
    $vs_artist_title = "^ca_entities.preferred_labels.displayname"; 
    $vs_artist_content = "<ifdef code='ca_entities.ulan.ulancode'> ^ca_entities.ulan.ulancomment</ifdef>".
                         "<ifnotdef code='ca_entities.ulan.ulancode'><ifdef code='ca_entities.wikidata.wikicode'>^ca_entities.wikidata.wikicomment</ifnotdef>";
                         

    $vs_media_template = "^ca_object_representations.media.large"; 
    //$vs_caption_template = "^ca_objects.preferred_labels.name";

    $vs_artist_media = "<unit relativeTo='ca_objects' length='1'>".
                            "^ca_object_representations.media.icon".
                        "</unit>";
    
    $vs_template = "<div class='hexagono'>".
                        "<div class='hexagono-content'>".
                            "<l>".   
                                "^ca_object_representations.media.large".           
                                "<h1> $vs_author_template </h1>".
                                "<p> ^ca_objects.preferred_labels.name </p>".              
                            "</l>".   
                        "</div>".
                    "</div>";

    $vs_artist_template = " <l><div class='triangle'>                            
                                <h3> $vs_artist_title </h3>
                                <p> 123321 - 123 123 12 </p>                                
                                 $vs_artist_media                                    
                            </div><l>";
    
?>
    
<div class='macusp-section'>   
    <h1> Algumas Obras em Destaque </h1>
    
    <p>A continuación, se presenta una selección de imágenes destacadas del acervo del Museu de Arte Contemporânea da Universidade de São Paulo (MAC USP). Este museo alberga una de las colecciones de arte moderno y contemporáneo más importantes de América Latina, con obras que abarcan diversas corrientes, técnicas y autores significativos del panorama artístico brasileño e internacional.
    </p>
    <p>Las imágenes que se muestran a continuación ofrecen una ventana a la riqueza y diversidad de esta colección. Podremos apreciar ejemplos de pintura, escultura, fotografía, grabado y otras expresiones artísticas que reflejan la evolución del arte a lo largo del siglo XX y XXI.

    </p>
    <p>Cada imagen nos invita a explorar diferentes lenguajes visuales, conceptualizaciones y diálogos con el contexto social, político y cultural de su tiempo. Desde abstracciones geométricas y líricas hasta representaciones figurativas y conceptuales, estas obras testimonian la vitalidad y la multiplicidad de la creación artística.

    </p>
    <p>A través de esta presentación, esperamos despertar la curiosidad y el interés por conocer más sobre el MAC USP y su valioso patrimonio artístico, que constituye una fuente inagotable de conocimiento y disfrute estético. Les invitamos a sumergirse en este universo de formas, colores e ideas que nos ofrecen estas imágenes.
    </p>

 
</div>     



<div class='mc-panal'>
        <?php 
            if($qr_works && $qr_works->numHits()){

                while($qr_works->nextHit()){
                    //print_r($qr_res);
                    if($vs_media = $qr_works->getWithTemplate($vs_media_template, array("checkAccess" => $va_access_values))){
                        //$vs_caption = $qr_res->getWithTemplate($vs_caption_template);
                        //$vs_author = $qr_res->getWithTemplate($vs_author_template);
                        
                        $vs_caption = $qr_works->getWithTemplate($vs_template);
                        
                        print $vs_caption;
                        
                    }
                }
            }
        ?>

    </div>

    <div class='boy'></div>
    <div style='width:100%;text-align:center;'><?php print caNavLink($this->request, _t("Ver todas as obras no Acervo "), "click", "acervo", "Artists", "List")?></div>
    









































<div class='macusp-section'>  
    <h1> Alguns Artistas Em Destaque </h1>
    <p> O acervo do MAC USP também conta com importantes obras de artistas internacionais de diversas correntes, como o Cubismo (Albert Gleizes, Georges Braque), o Surrealismo (Marc Chagall, Max Ernst), a Arte Metafísica (Giorgio de Chirico) e muitos outros.
    </p>
    <p>
Além dos nomes consagrados, o MAC USP também se dedica a apresentar e valorizar a produção de artistas emergentes e a diversidade da arte contemporânea, como demonstrado em iniciativas recentes como a incorporação de NFTs ao seu acervo com artistas como Gustavo Von Ha e as mostras do "Panorama da Arte Brasileira".
    </p><p>
Para ter uma visão mais completa dos artistas em destaque, recomendo acompanhar as exposições temporárias e a programação do MAC USP, bem como explorar o seu acervo online. Cada visita e pesquisa podem revelar novas perspectivas sobre os inúmeros talentos representados no museu.
    </p>
    
   
</div>     


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
                        
                        $vs_item = $qr_entities->getWithTemplate($vs_artist_template);

                        if ($vs_objects or True)
                        {
                            print $vs_item;
                        }
                    
                    }
                }
            }
        ?>
        
    </div>
    <div style='width:100%;text-align:center;'><?php print caNavLink($this->request, _t("Ver todos los artistas "), "click", "acervo", "Artists", "List")?></div>
    
















































<div class='macusp-section'>   
    <h1> Algumas Exposições em Destaque: </h1>
    <p>Mergulhe no universo da arte contemporânea explorando as diversas e instigantes exposições que o Museu de Arte Contemporânea da Universidade de São Paulo (MAC USP) oferece atualmente. De revisitações históricas a experimentações conceituais, o museu se apresenta como um espaço dinâmico para o encontro com a criação artística. A seguir, destacamos algumas das mostras imperdíveis que aguardam sua visita:
    </p>
</div>  

<div class='mc-panal'>
        <?php 
            if($qr_exhibitions && $qr_exhibitions->numHits()){

                while($qr_exhibitions->nextHit()){
                    //print_r($qr_res);
                    if($vs_media = $qr_exhibitions->getWithTemplate($vs_media_template, array("checkAccess" => $va_access_values)) or True ){
                        //$vs_caption = $qr_res->getWithTemplate($vs_caption_template);
                        //$vs_author = $qr_res->getWithTemplate($vs_author_template);
                        
                        $vs_caption = $qr_exhibitions->getWithTemplate("^ca_entities.preferred_labels.displayname <br> ");
                        
                        //print $vs_caption;
                        
                    
                    }
                }
            }
        ?>
        <div class='inProcess'></div>

    </div>
    <div style='width:100%;text-align:center;'><?php print caNavLink($this->request, _t("Ver todos los artistas "), "click", "acervo", "Exhibitions", "List")?></div>
    












































    

  <?php
	$menu = "<div class='toptitle'>".
  				"<div class='center-text'>".
	 			 	"Museu de Arte Comtenporâneo <br> Universidade de São Paulo".
  				"</div>".
  			"</div>".
			"<div>".
				"<div style='position: relative;'>".
					"<ul class='mc-nav'>".
						"<li>".caNavLink($this->request, _t("Artists "), "", "acervo", "Artists", "List")."</li>".
						"<li>".caNavLink($this->request, _t("Explore Acervo"), "", "", "","")."</li>".
						"<li>".caNavLink($this->request, _t("Macusp's Exhibitions "), "", "acervo", "Exhibitions", "List")."</li>".
					"</ul>".
				"</div>".
  			"</div>".
			"<div class='mc-language'>".
				caGetThemeGraphic($this->request, 'brazil.svg').
				"<span>Portuguese</span>".
			 	"<div class='mc-language-content '>".				  	
					"<a href='#'>".
						"English".
					"</a>".
					"<a href='#'>".
						"Spanish".
					"</a>".		
			  	"</div>".
		  	"</div>". 
			"<div class='firstcolor'></div>";
?>



<script type='text/javascript'>

	var menu = "<?php print $menu ?>";
	//$('.container.menuBar').style.backgroundcolor = "red";
	$('.container.menuBar').html(menu); 
    $('.container.menuBar').style.backgroundcolor = "red";
    
</script>

