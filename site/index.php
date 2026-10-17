<?php

// Generates the static home page at image build time: php site/index.php de|en > index.html
$lang = ($argv[1] ?? '') === 'en' ? 'en' : 'de';
$strings = parse_ini_file(__DIR__ . '/../config/translations.ini', true);
$t = $strings[$lang];
$badge = '<span class="text-xs bg-teal-700 text-gray-100 ring-1 ring-purple-400 px-1.5 py-1 mx-1 rounded">$1</span>';
?>
<!doctype html>
<html lang="<?= $t['html_lang'] ?>">
<head>
	<meta charset="UTF-8"/>
	<title><?= $t['title'] ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?= $t['meta_description'] ?>">
	<meta property="og:title" content="<?= $t['title'] ?>">
	<meta property="og:description" content="<?= $t['og_description'] ?>">
	<meta property="og:image" content="https://bitwaescherei.ch/static/img/BW-Logo-2022.png">
	<meta property="og:url" content="https://bitwaescherei.ch<?= $t['home'] ?>">
	<meta property="og:type" content="website">
	<link rel="canonical" href="https://bitwaescherei.ch<?= $t['home'] ?>">
	<link rel="alternate" hreflang="de" href="https://bitwaescherei.ch/">
	<link rel="alternate" hreflang="en" href="https://bitwaescherei.ch/en/">
	<link rel="alternate" hreflang="x-default" href="https://bitwaescherei.ch/">
	<link rel="icon" type="image/svg+xml" href="/static/img/bw-logo-2022.svg">
	<link rel="alternate icon" type="image/png" href="/static/img/BW-Logo-2022.png">
	<script src="/static/js/tailwind.js"></script>
	<!-- OpenLayers https://openlayers.org/download/ -->
	<link rel="stylesheet" href="/static/css/ol.css">
	<link rel="stylesheet" href="/static/css/simple-lightbox.css">
	<link rel="stylesheet" href="/static/css/bitw.css">
	<script src="/static/js/ol.js"></script>
	<script src="/static/js/simple-lightbox.js"></script>
</head>
<body class="bgcol">

<div class="relative z-10">
	<header class="page">
		<div class="flex justify-end mb-4">
			<div class="inline-flex items-center gap-2 bg-gradient-to-r from-purple-900/80 to-blue-900/80 border border-teal-400/50 rounded-full px-3 py-1 text-sm font-semibold shadow">
				<?php foreach (['de', 'en'] as $i => $l) { ?>
					<?php if ($i) { ?><span class="text-gray-500">|</span><?php } ?>
					<?php if ($l === $lang) { ?>
						<span class="text-teal-300"><?= strtoupper($l) ?></span>
					<?php } else { ?>
						<a href="<?= $strings[$l]['home'] ?>" class="text-gray-400 hover:text-teal-300 transition-colors" title="<?= $strings[$l]['switch_title'] ?>"><?= strtoupper($l) ?></a>
					<?php } ?>
				<?php } ?>
			</div>
		</div>
		<div class="block lg:flex lg:m-4">
			<div class="w-full lg:w-1/3">
				<a href="<?= $t['home'] ?>" title="Bitwäscherei" class="hover:animate-pulse">
					<svg width="220" height="220" class="m-auto lg:m-0">
						<image xlink:href="/static/img/bw-logo-2022.svg" src="/static/img/BW-Logo-2022.png" width="220" height="220"/>
					</svg>
				</a>
			</div>
			<div class="w-auto lg:w-2/3 mt-12">
				<blockquote class="lg:ml-12 lg:text-right">
					<div class="ml-1 -mt-2 mb-8 text-xl font-bold"><?= $t['tagline'] ?></div>
					<p>
						<?= preg_replace('/\{(\w+)\}/', $badge, $t['intro']) ?>
					</p>
				</blockquote>

				<div style="border-radius: 20px; margin-top: 50px; text-align: center; font-size:1.4em; padding:4px; background: rgba(200,100,100, 0.5)">
					<?= $t['mailing_banner'] ?> <a href="mailto:bitwascherei@chaostreff.ch" style="color: white;">bitwascherei@chaostreff.ch</a>
				</div>
			</div>
		</div>
	</header>
	<main class="page mb-5 px-2">
		<div class="w-full py-8">
			<div class="relative w-full">
				<div class="absolute -inset-1 bg-gradient-to-r from-purple-500 via-teal-300 to-blue-500 rounded-lg blur opacity-75 hover:opacity-100 transition duration-1000 hover:duration-200 animate-tilt"></div>
				<div class="relative px-2 py-1 w-full bg-gradient-to-r from-purple-400 via-teal-200 to-blue-400 rounded-lg ">
				</div>
			</div>
		</div>
		<section>
			<h2 class="text-3xl font-bold my-2 neon"><?= $t['h_project'] ?></h2>
			<a href="/static/img/PANO_20200822_235452~2.jpg" alt="<?= $t['panorama'] ?>"><img src="/static/img/PANO_20200822_235452~2-small.jpg" alt="<?= $t['panorama'] ?>" class="w-full rounded">
				<div>
					<?= $t['panorama'] ?>
				</div>
			</a>
			<div class="my-8 text-center align-content-center grid grid-cols-1 lg:grid-cols-3 gap-2">
				<a href="https://www.ccczh.ch/" target="_blank" rel="noopener noreferrer" class="transition bg-gradient-to-bl from-blue-800 to-purple-800 brightness-100 hover:brightness-50 ring-1 ring-purple-400 rounded p-2">
					<div class="font-weight-bold pt-1">Chaos Computer Club Zürich (CCCZH)</div>
					<br>
					<img src="/static/img/logos/ccczh.png" class="m-auto" style="height:80px;">
				</a>
				<a href="https://www.lugs.ch/lugs/" target="_blank" rel="noopener noreferrer" class="transition bg-gradient-to-bl from-blue-800 to-purple-800 brightness-100 hover:brightness-50 ring-1 ring-purple-400 rounded p-2">
					<div class="font-weight-bold pt-1">Linux User Group Switzerland (LUGS)</div>
					<br>
					<img src="/static/img/logos/lugs.gif" class="m-auto" style="height:80px;">
				</a>
				<a href="https://sgmk-ssam.ch/" target="_blank" rel="noopener noreferrer" class="transition bg-gradient-to-bl from-blue-800 to-purple-800 brightness-100 hover:brightness-50 ring-1 ring-purple-400 rounded p-2">
					<div class="font-weight-bold pt-1">SGMK - MechArtLab</div>
					<br>
					<img src="/static/img/logos/sgmk.png" class="m-auto" style="height:80px;">
				</a>
				<a href="https://www.digitale-gesellschaft.ch/" target="_blank" rel="noopener noreferrer" class="transition bg-gradient-to-bl from-blue-800 to-purple-800 brightness-100 hover:brightness-50 ring-1 ring-purple-400 rounded p-2">
					<div class="font-weight-bold pt-1"><?= $t['digiges_name'] ?></div>
					<br>
					<img src="/static/img/logos/digiges.png" class="m-auto" style="height:80px;">
				</a>
				<a href="https://www.hackteria.org/" target="_blank" rel="noopener noreferrer" class="transition bg-gradient-to-bl from-blue-800 to-purple-800 brightness-100 hover:brightness-50 ring-1 ring-purple-400 rounded p-2">
					<div class="font-weight-bold pt-1">Hackteria - Open Science Lab</div>
					<br>
					<img src="/static/img/logos/hackteria.png" class="m-auto" style="height:80px;">
				</a>
				<a href="https://uwu-space.ch/" target="_blank" rel="noopener noreferrer" class="transition bg-gradient-to-bl from-blue-800 to-purple-800 brightness-100 hover:brightness-50 ring-1 ring-purple-400 rounded p-2">
					<div class="font-weight-bold pt-1">UwU-Space</div>
					<br>
					<img src="/static/img/logos/uwu-space-logo.png" class="m-auto" style="height:80px;">
				</a>
			</div>

			<div class="mt-12">
				<h2 class="text-3xl font-bold my-4 neon"><?= $t['h_find'] ?></h2>
				<div class="block lg:flex gap-8">
					<div class="w-full lg:w-2/3" id="bitwMap"></div>
					<div class="w-full lg:w-1/3"><a href="https://zentralwaescherei.space/" target="_blank" rel="noopener noreferrer"><?= $t['zwz'] ?></a><br/><br/>Verein Bitwäscherei<br/>Neue Hard 12<br/>CH-8005 <?= $t['city'] ?><br/>+41 44 520 98 37<br/>
						<div style="font-size:.9em; margin-top:.5rem;">
							<?= $t['directions'] ?>
						</div>
					</div>
				</div>
			</div>

			<div class="mt-12 block lg:flex gap-8">
				<div class="w-full lg:w-2/3">
					<h2 class="text-3xl font-bold my-4 neon"><?= $t['h_events'] ?></h2>

					<p class="text-sm text-gray-400"><?= $t['disclaimer'] ?></p>
					<div class="overflow-x-scroll overflow-y-hidden flex gap-2 p-2" id="events" data-src="/event-cards.php?lang=<?= $lang ?>">
						<noscript><a href="/events.php"><?= $t['events_noscript'] ?></a></noscript>
					</div>
					<br>
					<ul class="event_overview">
						<li><span class="font-bold"><a href="https://mechatronicart.ch/mechartlab/" target="_blank" rel="noopener noreferrer">OpenLab</a> - <?= $t['openlab_when'] ?></span><br>
							<?= $t['openlab_desc'] ?>
						</li>
						<li><span class="font-bold"><a href="https://www.ccczh.ch/" target="_blank" rel="noopener noreferrer">ChaosTreff</a> - <?= $t['chaostreff_when'] ?></span><br>
							<?= $t['chaostreff_desc'] ?>
						</li>
						<li><span class="font-bold"><a href="https://uwu-space.ch" target="_blank" rel="noopener noreferrer">UwU-Space</a> - <?= $t['uwu_when'] ?></span><br>
							We are a Queer Hackspace centered around Zürich. We welcome all autistic sciencing around, from tech to trains and even chemistry. We are primarily English-speaking.
						</li>
						<li><span class="font-bold"><a href="https://www.lugs.ch/lugs/" target="_blank" rel="noopener noreferrer"><?= $t['lugs_name'] ?></a> - <?= $t['lugs_when'] ?></span><br>
							<?= $t['lugs_desc'] ?>
						</li>
						<li><span class="font-bold"><a href="https://www.digitale-gesellschaft.ch/" target="_blank" rel="noopener noreferrer"><?= $t['digiges_name'] ?></a> - <?= $t['digiges_when'] ?></span><br>
							<?= $t['digiges_desc'] ?>
						</li>
						<li><span class="font-bold"><a href="https://openstreetmap.org" target="_blank" rel="noopener noreferrer">Open Street Map</a> - <?= $t['osm_when'] ?></span><br>
							<?= $t['osm_desc'] ?>
						</li>
					</ul>
					<br>
					<p><b><?= $t['h_irregular'] ?></b></p>
					<ul class="space-y-4">
						<li><?= $t['irregular_1'] ?></li>
						<li><?= $t['irregular_2'] ?></li>
						<li><?= $t['irregular_3'] ?></li>
					</ul>
				</div>
				<div class="w-full lg:w-1/3 mt-12 lg:mt-0">
					<h2 class="text-3xl font-bold my-4 neon"><?= $t['h_informed'] ?></h2>
					<p><?= $t['informed'] ?></p>
					<p class="mt-4"><?= $t['mailing_subscribe'] ?> <a href="https://lists.chaostreff.ch/postorius/lists/bitwascherei.chaostreff.ch/">bitwascherei@chaostreff.ch</a>
					<div class="bg-gradient-to-br from-blue-800 to-purple-800 my-3">
						<div class="p-4">
							<div class="text-2xl text-teal-200"><?= $t['matrix_title'] ?></div>
							<p class="my-4">
								<?= $t['matrix_desc'] ?>
							</p>
							<a class="inline-block px-6 py-2 border-2 border-teal-400  font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out" href="https://plauder.chab.is" target="_blank" rel="noopener noreferrer">plauder.chab.is</a>
						</div>
					</div>
					<div class="bg-gradient-to-br from-blue-800 to-purple-800 my-6">
						<div class="p-4">
							<div class="text-2xl text-teal-200">Wiki</div>
							<p><?= $t['wiki_desc'] ?></p>
							<a class="inline-block px-6 py-2 border-2 border-teal-400 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out" href="https://wiki.digitale-gesellschaft.ch/" target="_blank" rel="noopener noreferrer"><?= $t['wiki_button'] ?></a>
						</div>
					</div>
					<div class="bg-gradient-to-br from-blue-800 to-purple-800 my-6">
						<div class="p-4">
							<div class="text-2xl text-teal-200"><?= $t['h_good_to_know'] ?></div>
							<ul class="ml-6 list-disc space-y-2">
								<li><?= $t['drinks'] ?></li>
								<li><?= $t['door'] ?></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="mt-12">
			<h2 class="text-3xl font-bold my-4 neon"><?= $t['h_gallery'] ?></h2>
			<div class="container gap-2">
				<div class="flex flex-wrap -m-1 md:-m-2" id="gallery">
					<?php foreach (['028', '027', '026', '025', '024', '017', '018', '019', '020', '021', '022', '023', '001', '003', '004', '005', '006', '007', '008', '009', '010', '011', '012', '013', '014', '015', '016'] as $img) { ?>
						<div class="flex flex-wrap w-1/2 lg:w-1/4">
							<a href="/static/img/gallery/<?= $img ?>.jpg" class="w-full h-64 p-1 md:p-2">
								<img alt="<?= $t['gallery_alt'] ?>" class="hover:brightness-50 transition block object-cover object-center w-full h-full rounded"
									 src="/static/img/gallery/small/<?= $img ?>.jpg">
							</a>
						</div>
					<?php } ?>
				</div>
			</div>
		</section>

		<section class="mt-12" id="charter">
			<h2 class="text-3xl font-bold my-4 neon"><?= $t['charter_title'] ?></h2>
			<div class="container gap-4 space-y-4">
				<?= $t['charter'] ?>
			</div>
		</section>

		<footer class="pt-4 my-8 text-teal-200">
			<div class="w-full py-8">
				<div class="relative w-full">
					<div class="absolute -inset-1 bg-gradient-to-r from-purple-500 via-teal-300 to-blue-500 rounded-lg blur opacity-75 hover:opacity-100 transition duration-1000 hover:duration-200 animate-tilt"></div>
					<div class="relative px-2 py-1 w-full bg-gradient-to-r from-purple-400 via-teal-200 to-blue-400 rounded-lg ">
					</div>
				</div>
			</div>

			<div class="flex justify-between px-4">
				<div>
					<a data-modal="modal-one" style="cursor:pointer"><?= $t['legal_link'] ?></a>
				</div>
				<div class="w-1/3 text-right">
					<a href="https://github.com/bitwaescherei/bitwaescherei" target="_blank" rel="noopener noreferrer">
						Fork on Github:
						<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
							 width="30" height="30"
							 viewBox="0 0 30 30"
							 style="display:inline; fill:#70eac0;">
							<path d="M15,3C8.373,3,3,8.373,3,15c0,5.623,3.872,10.328,9.092,11.63C12.036,26.468,12,26.28,12,26.047v-2.051 c-0.487,0-1.303,0-1.508,0c-0.821,0-1.551-0.353-1.905-1.009c-0.393-0.729-0.461-1.844-1.435-2.526 c-0.289-0.227-0.069-0.486,0.264-0.451c0.615,0.174,1.125,0.596,1.605,1.222c0.478,0.627,0.703,0.769,1.596,0.769 c0.433,0,1.081-0.025,1.691-0.121c0.328-0.833,0.895-1.6,1.588-1.962c-3.996-0.411-5.903-2.399-5.903-5.098 c0-1.162,0.495-2.286,1.336-3.233C9.053,10.647,8.706,8.73,9.435,8c1.798,0,2.885,1.166,3.146,1.481C13.477,9.174,14.461,9,15.495,9 c1.036,0,2.024,0.174,2.922,0.483C18.675,9.17,19.763,8,21.565,8c0.732,0.731,0.381,2.656,0.102,3.594 c0.836,0.945,1.328,2.066,1.328,3.226c0,2.697-1.904,4.684-5.894,5.097C18.199,20.49,19,22.1,19,23.313v2.734 c0,0.104-0.023,0.179-0.035,0.268C23.641,24.676,27,20.236,27,15C27,8.373,21.627,3,15,3z"></path>
						</svg>

					</a>
				</div>
			</div>
		</footer>
	</main>
</div>
<div class="w-full fixed z-5 -top-20 -right-20">
	<div class="neonball"></div>
</div>
<div class="modal" id="modal-one">
	<div class="modal-bg modal-exit"></div>
	<div class="modal-container mx-8 relative">
		<button class="modal-close modal-exit bg-red-500 rounded-2xl p-2 m-2 absolute right-10">X</button>
		<h1 class="text-3xl my-2"><?= $t['legal_title'] ?></h1>

		<h2 class="text-2xl my-2"><?= $t['privacy_title'] ?></h2>
		<p><?= $t['privacy_intro'] ?></p>
		<ul class="list-disc space-y-2 ml-4">
			<li><?= $t['privacy_1'] ?></li>
			<li><?= $t['privacy_2'] ?></li>
			<li><?= $t['privacy_3'] ?></li>
		</ul>

		<h2 class="text-2xl my-2"><?= $t['imprint_title'] ?></h2>
		<p>
			Verein Bitwäscherei<br>
			Neue Hard 12<br>
			8005 <?= $t['city'] ?><br>
			<?= $t['country'] ?><br>
			<br>

			+41 44 520 98 37 <?= $t['phone_note'] ?>
		</p>
	</div>
</div>

<script src="/static/js/bitw.js"></script>
</body>
</html>
