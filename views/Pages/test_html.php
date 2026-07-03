<?php
/** ---------------------------------------------------------------------
 * themes/default/Front/front_page_html : Front page of site 
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2013 Whirl-i-Gig
 *
 * For more information visit http://www.CollectiveAccess.org
 *
 * This program is free software; you may redistribute it and/or modify it under
 * the terms of the provided license as published by Whirl-i-Gig
 *
 * CollectiveAccess is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTIES whatsoever, including any implied warranty of 
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
 *
 * This source code is free and modifiable under the terms of 
 * GNU General Public License. (http://www.gnu.org/copyleft/gpl.html). See
 * the "license.txt" file for details, or visit the CollectiveAccess web site at
 * http://www.CollectiveAccess.org
 *
 * @package CollectiveAccess
 * @subpackage Core
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License version 3
 *
 * ----------------------------------------------------------------------
 */
		//print $this->render("Front/featured_set_slideshow_html.php");
?>
<div class='carrousel'>	
	<div class='macusp-carrousel'>
        <li style="background-image: url('https://raw.githubusercontent.com/R-CoderDotCom/samples/main/bird.png');">
          <div class="details">
            <h1> Slide Second </h1>
            <p> la vida es un kaos</p>
          
  
          </div>
  
        </li>
  
        <li style="background-image: url('https://raw.githubusercontent.com/R-CoderDotCom/samples/main/bird.png');">
          <div class="details">
            <h1> Slide Third </h1>
            <p> la vida es un kaos</p>
          
  
          </div>
  
        </li>
  
        <li style="background-image: url('https://raw.githubusercontent.com/R-CoderDotCom/samples/main/bird.png');">
          <div class="details">
            <h1> Slide Forth </h1>
            <p> la vida es un kaos</p>
          
  
          </div>
  
        </li>
        <li style="background-image: url('https://raw.githubusercontent.com/R-CoderDotCom/samples/main/bird.png');">
          <div class="details">
            <h1> Slide Fith</h1>
            <p> la vida es un kaos</p>
          
  
          </div>
  
        </li>
  
        <li style="background-image: url('https://raw.githubusercontent.com/R-CoderDotCom/samples/main/bird.png');">
           <div class="details">
            <h1> Slide Fith</h1>
            <p> la vida es un kaos</p>
          
  
          </div>
  
        </li>
  
        <li style="background-image: url('https://raw.githubusercontent.com/R-CoderDotCom/samples/main/bird.png');">
          <div class="details">
            <h1> <a href="">Slide Fith</a></h1>
            <p> la vida es un kaos</p>
          
  
          </div>
  
        </li>
  
        <li style="background-image: url('https://raw.githubusercontent.com/R-CoderDotCom/samples/main/bird.png');">
           <div class="details">
            <h1> Slide Fith</h1>
            <p> la vida es un kaos</p>
          
  
          </div>
  
        </li>
  
        <li style="background-image: url('https://raw.githubusercontent.com/R-CoderDotCom/samples/main/bird.png');">
          <div class="details">
            <h1> Slide Fith</h1>
            <p> la vida es un kaos</p>
          
  
          </div>
        </li>
  
        <li style="background-image: url('https://raw.githubusercontent.com/R-CoderDotCom/samples/main/bird.png');">
           <div class="details">
            <h1> Slide One </h1>
            <p> la vida es un kaos</p>
          
  
          </div>
  
        </li>    
  
	</div>
</div>
	<script type="text/javascript">
				jQuery(document).ready(function() {
					jQuery("#browseResultsContainer").load("<?php print caNavUrl($this->request, 'macusp', 'artists', 'index', array(), array('dontURLEncodeParameters' => true)); ?>", function() {
						jQuery('#browseResultsContainer').jscroll({
							autoTrigger: true,
							loadingHtml: '<?php print caBusyIndicatorIcon($this->request).' '.addslashes(_t('Loading...')); ?>',
							padding: 20,
							nextSelector: 'a.jscroll-next'
						});
					});
					
					
				});
			</script>
	<div class="row">
		<div class="col-sm-8">
			<H1>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis vulputate, orci quis vehicula eleifend, metus elit laoreet elit.</H1>
		</div><!--end col-sm-8-->
		<div class="col-sm-4">
<?php
		//print $this->render("Front/gallery_set_links_html.php");
?>
		<head>
  <link rel="stylesheet" type="text/css" href="style.css">
  
  
  
</head>


<body>
	<br>

    
      <div class="controls">
        <button class="prev">prev</button>
        <button class="next">next </button>
  
      </div>
    
  
  <script type='text/javascript'>

const prevBtn = document.querySelector('.prev');
const nextBtn = document.querySelector('.next');

function myfunction(){
  const menu = document.querySelector('macusp-carrousel');
  const cards = document.querySelectorAll('.macusp-carrousel.li');
  menu.appendChild(cards[0]);
}

setInterval(myfunction, 4000);

nextBtn.addEventListener('click', myfunction)

prevBtn.addEventListener('click', () => {
  const menu = document.querySelector('macusp-carrousel');
  const cards = document.querySelectorAll('.macusp-carrousel.li');
  menu.prepend(cards[cards.length - 1]);
  
})

  </script>
</body>
		</div> <!--end col-sm-4-->	
	</div><!-- end row -->