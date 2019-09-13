<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<ul class="cb-slideshow">
	<?php
		foreach ($slideshows as $slide) {
			echo '<li><span></span><div><h3>'.$slide['caption'].'</h3></div></li>';
		}
	?>
</ul>
<div class="container">
	<header>
		<h1>Welcome <span>To This Landing Page</span></h1>
		<h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</h2>
	</header>
</div>

<script>
	$('#navbar').addClass(['navbar-dark', 'bg-transparent']);
	$('#home-link').addClass('active');
	$("body").css("overflow", "hidden");
</script>