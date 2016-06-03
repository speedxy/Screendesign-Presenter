<?php
$putenv = putenv('LC_ALL=de_DE');
setlocale(LC_ALL, 'de_DE.UTF-8');
bindtextdomain("screens", "./locale");
textdomain("screens");

/**
 *	Read all files from folder
 */
function getFiles($dir = ".", $ending = NULL) {
	if(!is_dir($dir))
		return false;
	$verz = @opendir($dir);
	while($files = @readdir($verz)) {
		if($files[0] == "." || is_dir($dir . "/" . $files))
			continue;
		if($ending == NULL) {
			$return[] = $files;
			// No file ending definied
			continue;
		}

		$end = strtolower(strrchr($files, "."));
		if(is_array($ending) && in_array($end, $ending)) {
			$return[] = $files;
			continue;
		}
		if($ending == $end) {
			$return[] = $files;
			continue;
		}
	}
	if($return)
		sort($return);
	return $return;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>screens: Screendesign-Presenter</title>
	<link href="/assets/css/style.css" media="screen" rel="stylesheet" type="text/css" />
	<script>
		var locale = {
			previousScreen: '<?=_("Previous Screen")?>',
			nextScreen: '<?=_("Next Screen")?>'
		};
	</script>
</head>
<body data-show-intro="true">
	<div id="intro">
		<h1><?=_("Welcome")?></h1>
		<p><?=_("Use the following keys to navigate between the screens")?>:</p>
		<div class="row">
			<dl class="col">
				<dt><span class="key">&larr;</span></dt>
				<dd><?=_("Go one slide back")?></dd>
				<dt><span class="key">&rarr;</span></dt>
				<dd><?=_("Go one slide forward")?></dd>
				<dt><span class="key">&uarr;</span></dt>
				<dd><?=_("Go to the first slide")?></dd>
				<dt><span class="key">&darr;</span></dt>
				<dd><?=_("Go to the last slide")?></dd>
			</dl>
			<dl class="col">
				<dt><span class="widekey key">esc</span></dt>
				<dd><?=_("Show/hide this screen")?></dd>
				<dt><span class="key">n</span></dt>
				<dd><?=_("Show/hide the navigation")?></dd>
				<dt><span class="key">0</span> - <span class="key">9</span></dt>
				<dd><?=_("Go to the corresponding slide. 0 is slide number 10.")?></dd>
				<dt><span class="key">c</span></dt>
				<dd><?=_("Toggle the capture mode. This mode is great for screenshots.")?></dd>
			</dl>
			<dl>
				<dt><span class="space key"><?=_("space")?></span></dt>
				<dd>
					<?=_("Next Step")?> <br />
					<small><?=_("Hide this message or go to the next slide. <br />If you are on the last slide, it returns to the first slide.")?></small>
				</dd>
			</dl>
		</div>
	</div>
	<div id="wrapper">
		<?php
		$project = basename($_GET["project"]);
		$dir = realpath(__DIR__ . "/screens/" . $project . "/") . "/";
		$files = getFiles($dir, array(".jpg", ".png"));
		if($files){
			foreach($files as $file) {
				// Read image dimensions
				$size = getimagesize($dir . $file);
				// Generate image description from filename
				$image_name = pathinfo(basename($file), PATHINFO_FILENAME);
				$image_name = strtr($image_name, array("-" => " ", "_" => " ", "." => " "));
				// Output image tag
				echo '<img src="/screens/' . $project . "/" . $file . '" ' . $size[3] . ' alt="' . $image_name . '">'."\n";
			}
		}else{
			?>	<div>
				<?=_("Please define a project.")?>
			</div>
			<?php
		}
		?>
	</div>
	<div id="screen_info"><p></p></div>
	<script type="text/javascript" src="/assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="/assets/js/browser.js"></script>
	<script type="text/javascript" src="/assets/js/hashchange.js"></script>
	<script type="text/javascript" src="/assets/js/onReady.js"></script>
</body>
</html>