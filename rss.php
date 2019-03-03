<style>
	.rss_news_table {
		text-align: left;
		width:30em;
		border: 1px solid #000000;
		font-size:12pt;
		font-family: Arial;
	}
	.rss_news_table th {
		color: #000000;
		font-size: 12px;
		font-family: Arial;
		background-color: #EFEFEF;
		padding: 0 0 0 0;
	}
	.rss_news_table td {
		color: #000000;
		font-size: 12px;
		background-color: #FFFFFF;
		font-family: Arial;
		padding: 0 0 4 0;
	}
	.rss_news_table span {
		color: #666666;
		font-family: Arial;
		font-size: 9px;
	}
</style>
<?php
$url = 'http://feeds.feedburner.com/thexyzfeed';
$text = file_get_contents($url);
$text = iconv('UTF-8', 'UTF-8//IGNORE', $text);
$dom = new DOMDocument();
$dom->loadXML($text);
$items = $dom->getElementsByTagName('item');
$data = array();
foreach ($items as $item) {
	$data[] = array(
		'title' => $item->getElementsByTagName('title')->item(0)->textContent,
		'link' => $item->getElementsByTagName('link') ->item(0)->textContent,
		'description' => strip_tags($item->getElementsByTagName('description')->item(0)->textContent),
		'date' => (($date = $item->getElementsByTagName('pubDate')->item(0)) ? $date->textContent : '')
	);
}
?>
<table class="rss_news_table" align="center">
<?php foreach ($data as $item) { ?>
	<tr>
		<th align="left">
			<a href="<?=$item['link']?>"><?=$item['title']?></a><br />
			<span><?=$item['date']?></span>
		</th>
	</tr>
	<tr>

	</tr>
<?php } ?>
</table>