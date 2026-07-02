<?php	

	$display = $this->getVar('display');
	
?>
<div class="row" style="margin-top:20px">
    <div class="col-sm-1 " style='border-right:1px solid #ddd;'>
    </div>
	<div class="col-sm-7 " style='border-right:1px solid #ddd;'>
		<h1><?php print _t("Full Results for <span style='color:black;'>%1</span>", $display); ?></h1>

	
		
		<?php //print $this->render($vn_view); ?>
		<?php print $this->render("Search/advanced_search_results.php"); ?>	

	</div>
	<div class="col-sm-3" >
        <div id='additional-info' class='additional-info'>
            <div class='message'> <?php print _t("Quick tips"); ?> </div>
			<ul>
				<li><?php print _t("Click on the icon %1 for details about a work, exhibition, or artist.", "<span class='glyphicon glyphicon-info-sign'></span>") ?></li>					
			</ul>
        </div>
	</div><!-- end col -->
    <div class="col-sm-1" >
      
	</div><!-- end col -->
</div><!-- end row -->

<script>
	jQuery(document).ready(function() {
		$('.MacuspAdvancedForm .formLabel').popover(); 
	});
	
</script>


<script>
	function getInfoArtist(idno)
    {   
        jQuery("#additional-info").html("Loading... <i class='fa fa-spinner fa-spin'></i>");         

        jQuery.getJSON('<?php print caNavUrl($this->request, '', 'Info', 'artist'); ?>', {idno}, function(data) {
            jQuery("#additional-info").html(data); 
        }); 
    }   

	function getInfoExhibition(idno)
    {   
        jQuery("#additional-info").html("Loading... <i class='fa fa-spinner fa-spin'></i>");         

        jQuery.getJSON('<?php print caNavUrl($this->request, '', 'Info', 'exhibition'); ?>', {idno}, function(data) {
            jQuery("#additional-info").html(data); 
        }); 
    }   

	function getInfoWork(idno)
    {   
        jQuery("#additional-info").html("Loading... <i class='fa fa-spinner fa-spin'></i>");         

        jQuery.getJSON('<?php print caNavUrl($this->request, '', 'Info', 'work'); ?>', {idno}, function(data) {
            jQuery("#additional-info").html(data); 
        }); 
    }   
	
</script>

<script type='text/javascript'>
	window.onscroll = function() {myFunction()};

	var header = document.getElementById("additional-info");
	var sticky = header.offsetTop;

	function myFunction() {
		if (window.pageYOffset > sticky) {
			header.style.top = String(Math.max(window.pageYOffset - 150, 0)) + "px";
		}
		else
		{
			
		}
	}
</script>











































<div class="row">
	<div class="col-sm-8 " style='border-right:1px solid #ddd;'>
		<!-- <h1>Objects Advanced Search</h1> -->
		


	</div>
	
	<!-- Estou tirando isso por enquanto
	<div class="col-sm-4" >
		<h1>Helpful Links</h1>
		<p>Include some helpful info for your users here.</p>
	</div>--><!-- end col
	Estou tirando isso por enquanto -->
	
</div><!-- end row -->

<script>
	jQuery(document).ready(function() {
		$('.advancedSearchField .formLabel').popover(); 
	});
	
</script>

