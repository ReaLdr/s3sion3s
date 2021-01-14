<script type="text/javascript">
		$(document).ready(function() {
		
			$("a[rel=actas]").fancybox({
			
				'transitionIn'		: 'elastic',
				'transitionOut'		: 'elastic',
				'titlePosition' 	: 'over',
				'autoScale'			: false,
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
					return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
				}
			});
			
			
					$("a[rel=md5]").fancybox({
				'transitionIn'		: 'elastic',
				'transitionOut'		: 'elastic',
				'autoScale'			: false,
				 });
				
	</script>