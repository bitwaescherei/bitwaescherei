<?php
// HTML fragment with the next events, loaded into the static home pages by bitw.js

require_once('Page.php');
$page = new Page(($_GET['lang'] ?? '') === 'en' ? 'en' : 'de');
?>
<?php foreach ($page->getNextEvents() as $event) { ?>
	<div class="group bg-gradient-to-br from-blue-800 to-purple-800 my-3 p-2 w-[300px] flex-none relative">
		<div class="text-xs absolute right-2 ml-2 mt-1 inline py-0.5 px-1.5 ring-1 ring-purple-400 bg-purple-900 rounded-xl uppercase"><?= $event['verein'] ?></div>

		<div class="font-bold"><?= $event['startdate'] ?></div>
		<?php if ($event['multiday']) { ?>
			<div class="h-6 text-sm"><?= $event['enddate'] ?></div>
		<?php } else { ?>
			<div class="h-6"></div>
		<?php } ?>
		<div class="mb-2 text-xl">
			<?= $event['title'] ?>
		</div>
		<div class="text-sm min-h-[100px] h-24 transition-all duration-500 ease-in-out overflow-hidden group-hover:h-full"><?= $event['description'] ?></div>
	</div>
<?php } ?>
