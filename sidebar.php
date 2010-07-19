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
<?php } elseif(basename($_SERVER['PHP_SELF'],'.php') == "teams" && ($_SERVER['QUERY_STRING'] == 'team_rocket') { ?>
	<h2 class="twitter">Twitter Feed</h2>
	<script type="javascript">
	new TWTR.Widget({
	  version: 2,
	  type: 'profile',
	  rpp: 4,
	  interval: 6000,
	  width: 250,
	  height: 300,
	  theme: {
		shell: {
		  background: '#333333',
		  color: '#ffffff'
		},
		tweets: {
		  background: '#000000',
		  color: '#ffffff',
		  links: '#4aed05'
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
	}).render().setUser('uwteamsters').start();
	</script>
<?php } elseif(basename($_SERVER['PHP_SELF'],'.php') == "teams" && ($_SERVER['QUERY_STRING'] == 'elite_four') { ?>
	<h2 class="twitter">Twitter Feed</h2>
	<script type="javascript">
	new TWTR.Widget({
	  version: 2,
	  type: 'profile',
	  rpp: 4,
	  interval: 6000,
	  width: 250,
	  height: 300,
	  theme: {
		shell: {
		  background: '#333333',
		  color: '#ffffff'
		},
		tweets: {
		  background: '#000000',
		  color: '#ffffff',
		  links: '#4aed05'
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
	}).render().setUser('tie_guard').start();
	</script>
<?php } 
if(!(basename($_SERVER['PHP_SELF'],'.php') == "main" && !($_SERVER['QUERY_STRING']))) { ?>
} ?>
</div>
