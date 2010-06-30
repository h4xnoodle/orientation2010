<div id="sidebar">
<?php if(basename($_SERVER['PHP_SELF'],'.php') == "main" && !($_SERVER['QUERY_STRING'])) { ?>
	<?php include "suggestionbox.php"; ?>
<?php } ?>

<?php 
if(basename($_SERVER['PHP_SELF'],'.php') == "faq") { ?>



<?php } else if(basename($_SERVER['PHP_SELF'],'.php') == "main" && !($_SERVER['QUERY_STRING'])) { ?>
	<h2 class="twitter">Twitter</h2>
	<script type="text/javascript">
		new TWTR.Widget({
		  version: 2,
		  type: 'profile',
		  rpp: 4,
		  interval: 6000,
		  width: 'auto',
		  height: 350,
		  theme: {
			shell: {
			  background: '#ffffff',
			  color: '#6e6e6e'
			},
			tweets: {
			  background: '#ffffff',
			  color: '#8c8c8c',
			  links: '#eb8db6'
			}
		  },
		  features: {
			scrollbar: false,
			loop: false,
			live: false,
			hashtags: true,
			timestamp: true,
			avatars: false,
			behavior: 'all'
		  }
		}).render().setUser('mathorientation').start();
	</script>
<?php } ?>
<?php if(!(basename($_SERVER['PHP_SELF'],'.php') == "main" && !($_SERVER['QUERY_STRING']))) { ?>
<?php } ?>
</div>
