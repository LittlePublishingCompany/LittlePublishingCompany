<?php
	// Generates a Google ad based on the selector
	function GenAd($selector) {
		
		$header = '
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- Header -->
			<ins class="adsbygoogle"
				 style="display:inline-block;width:468px;height:60px"
				 data-ad-client="ca-pub-5604793780709224"
				 data-ad-slot="7832602393"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
		';
		
		$footer = '
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- Footer -->
			<ins class="adsbygoogle"
				 style="display:inline-block;width:728px;height:90px"
				 data-ad-client="ca-pub-5604793780709224"
				 data-ad-slot="9856222395"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
		';
		
		$mediumRectangle = '
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- Medium Rectangle -->
			<ins class="adsbygoogle"
				 style="display:inline-block;width:300px;height:250px"
				 data-ad-client="ca-pub-5604793780709224"
				 data-ad-slot="9381557599"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
		';
		
		$responsive = '
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- Responsive -->
			<ins class="adsbygoogle"
				 style="display:block"
				 data-ad-client="ca-pub-5604793780709224"
				 data-ad-slot="3195423196"
				 data-ad-format="auto"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
		';
		
		$wideSkyscraper = '
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- Wide Skyscraper -->
			<ins class="adsbygoogle"
				 style="display:inline-block;width:160px;height:600px"
				 data-ad-client="ca-pub-5604793780709224"
				 data-ad-slot="2857345995"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
		';
		
		$halfBanner = '
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- Half Banner -->
			<ins class="adsbygoogle"
				 style="display:inline-block;width:234px;height:60px"
				 data-ad-client="ca-pub-5604793780709224"
				 data-ad-slot="7948523590"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
		';
		
		if ($selector == 'header') {
			$code = $header;
		} else if ($selector == 'footer') {
			$code = $footer;
		} else if ($selector == 'mediumRectangle') {
			$code = $mediumRectangle;
		} else if ($selector == 'responsive') {
			$code = $responsive;
		} else if ($selector == 'wideSkyscraper') {
			$code = $wideSkyscraper;
		} else if ($selector == 'halfBanner') {
			$code = $halfBanner;
		} else {
			$code = 'no ad';
		}
		
		$ad = '
			<div class="ad">' . 
				$code . 
			'</div>
		';
		
		echo $ad;
	}

?>