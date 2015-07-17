<?php
	$contentDay = 'Friday';
	$contentTime = '08:00:00';

	// "This Week" Section
	$dateRange = WeekDateRange('current', $contentDay, $contentTime);
	$publishedChapters = FindPublishedChapters($dateRange['startDate'], $dateRange['endDate']);
	
	$size = count($publishedChapters);
	if ($size > 0) {
		echo '<h1 class="infoBlockHeading">This Week</h1>';
		echo '<div class="blockContainer" align="center">';
			for ($i = 0; $i < $size; $i++) {
				$chapter = GetChapterByID($publishedChapters[$i]['ChapterID']);
				CreateContentBlock('chapter', $chapter);
			}
		echo '</div><br>';
	}
	
	// Ad
	echo '<div align="center">';
        GenAd('footer');
    echo '</div><br>';
	
	// "Last Week" Section
	$dateRange = WeekDateRange('last', $contentDay, $contentTime);
	$publishedChapters = FindPublishedChapters($dateRange['startDate'], $dateRange['endDate']);
	
	$size = count($publishedChapters);
	if ($size > 0) {
		echo '<h1 class="infoBlockHeading">Last Week</h1>';
		echo '<div class="blockContainer" align="center">';
			for ($i = 0; $i < $size; $i++) {
				$chapter = GetChapterByID($publishedChapters[$i]['ChapterID']);
				CreateContentBlock('chapter', $chapter);
			}
		echo '</div><br>';
	}
	
	// Ad
	echo '<div align="center">';
        GenAd('footer');
    echo '</div><br>';
	
	// "Older" Section
	$dateRange = WeekDateRange('older', $contentDay, $contentTime);
	$publishedChapters = FindPublishedChapters($dateRange['startDate'], $dateRange['endDate']);
	
	$size = count($publishedChapters);
	if ($size > 0) {
		echo '<h1 class="infoBlockHeading">Previously on Little Publishing Company</h1>';
		echo '<div class="blockContainer" align="center">';
			for ($i = 0; $i < $size; $i++) {
				$chapter = GetChapterByID($publishedChapters[$i]['ChapterID']);
				CreateContentBlock('chapter', $chapter);
			}
		echo '</div><br>';
	}
	
	// "Essays" Section
	echo '<h1 class="infoBlockHeading">Essays</h1>
	<br>
	<div style="margin-left:75px; margin-right:75px;">';
	
	$story = GetStoryByID(2);
	$size = count($story['Chapters']);
	for ($i = 0; $i < $size; $i++) {
		$chapter = GetChapterByID($story['Chapters'][$i]['ChapterID']);
		$zIndex = $size - $i;
		CreateContentEntry('chapter', $chapter, '', '', $zIndex);
	}
	
	echo '</div><br>';
?>