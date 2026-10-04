<?php

require_once(__DIR__ . '/../Page.php');
$page = new Page();
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8"/>
	<title>Bitwäscherei - Hackerspace in Zurich (Hardbrücke)</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Bitwäscherei - Hackerspace collective in Zurich (Hardbrücke). An alliance of CCCZH, SGMK, DigiGes, LUGS, Hackteria, and UwU-Space.">
	<meta property="og:title" content="Bitwäscherei - Hackerspace in Zurich (Hardbrücke)">
	<meta property="og:description" content="Hackerspace collective in the heart of Zurich. Community uniting CCCZH, SGMK, DigiGes, LUGS, Hackteria, and UwU-Space.">
	<meta property="og:image" content="/static/img/BW-Logo-2022.png">
	<meta property="og:url" content="https://bitwaescherei.ch/en/">
	<meta property="og:type" content="website">
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
				<a href="/" class="text-gray-400 hover:text-teal-300 transition-colors" title="Auf Deutsch wechseln">DE</a>
				<span class="text-gray-500">|</span>
				<span class="text-teal-300">EN</span>
			</div>
		</div>
		<div class="block lg:flex lg:m-4">
			<div class="w-full lg:w-1/3">
				<a href="/en/" title="Bitwäscherei" class="hover:animate-pulse">
					<svg width="220" height="220" class="m-auto lg:m-0">
						<image xlink:href="/static/img/bw-logo-2022.svg" src="/static/img/BW-logo-2022.png" width="220" height="220"/>
					</svg>
				</a>
			</div>
			<div class="w-auto lg:w-2/3 mt-12">
				<blockquote class="lg:ml-12 lg:text-right">
					<div class="ml-1 -mt-2 mb-8 text-xl font-bold">Hackerspace Collective in Zurich</div>
					<p>
						In summer 2020, a new hackerspace community emerged in the heart of Zurich as a collective endeavor uniting Chaos Computer Club Zürich <span class="text-xs bg-teal-700 text-gray-100 ring-1 ring-purple-400 px-1.5 py-1 mx-1 rounded">CCCZH</span>, Swiss Mechatronic Art Society <span class="text-xs bg-teal-700 text-gray-100 ring-1 ring-purple-400 px-1.5 py-1 mx-1 rounded">SGMK</span>, Digital Society <span class="text-xs bg-teal-700 text-gray-100 ring-1 ring-purple-400 px-1.5 py-1 mx-1 rounded">DigiGes</span>, Linux User Group Switzerland <span class="text-xs bg-teal-700 text-gray-100 ring-1 bg-teal-700 px-1.5 py-1 mx-1 rounded">LUGS</span>, later joined by Hackteria and UwU-Space.
					</p>
				</blockquote>

				<div style="border-radius: 20px; margin-top: 50px; text-align: center; font-size:1.4em; padding:4px; background: rgba(200,100,100, 0.5)">
					Subscribe to our mailing list: <a href="mailto:bitwascherei@chaostreff.ch" style="color: white;">bitwascherei@chaostreff.ch</a>
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
			<h2 class="text-3xl font-bold my-2 neon">The Project</h2>
			<a href="/static/img/PANO_20200822_235452~2.jpg" alt="Panorama of the Bitwäscherei"><img src="/static/img/PANO_20200822_235452~2-small.jpg" alt="Panorama of the Bitwäscherei" class="w-full rounded">
				<div>
					Panorama of the Bitwäscherei
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
					<div class="font-weight-bold pt-1">Digital Society (DigiGes)</div>
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
				<h2 class="text-3xl font-bold my-4 neon">How to find us</h2>
				<div class="block lg:flex gap-8">
					<div class="w-full lg:w-2/3" id="bitwMap"></div>
					<div class="w-full lg:w-1/3"><a href="https://zentralwaescherei.space/" target="_blank" rel="noopener noreferrer">Former Zentralwäscherei Zürich</a><br/><br/>Verein Bitwäscherei<br/>Neue Hard 12<br/>CH-8005 Zurich<br/>+41 44 520 98 37<br/>
						<div style="font-size:.9em; margin-top:.5rem;">
							(Access to the courtyard through the large gate, then immediately turn right between the building and garages, through the glass door into the building on the left, then 3rd floor on the right)
						</div>
					</div>
				</div>
			</div>

			<div class="mt-12 block lg:flex gap-8">
				<div class="w-full lg:w-2/3">
					<h2 class="text-3xl font-bold my-4 neon">What's happening right now</h2>

					<p class="text-sm text-gray-400">Subject to change - without guarantee. Please check with the respective organizer whether and how the event takes place.</p>
					<div class="overflow-x-scroll overflow-y-hidden flex gap-2 p-2">
						<?php foreach ($page->getNextEvents(10, 'en') as $event) { ?>
							<div class="group bg-gradient-to-br from-blue-800 to-purple-800 my-3 p-2 w-[300px] flex-none relative">
								<div class="text-xs absolute right-2 ml-2 mt-1 inline py-0.5 px-1.5 ring-1 ring-purple-400 bg-purple-900 rounded-xl uppercase"><?= $event['verein'] ?></div>

								<div class="font-bold"><?= $event['startdate'] ?></div>
								<?php if (substr($event['startdate'], 0, 10) != substr($event['enddate'], 0, 10)) { ?>
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
					</div>
					<br>
					<ul class="event_overview">
						<li><span class="font-bold"><a href="https://mechatronicart.ch/mechartlab/" target="_blank" rel="noopener noreferrer">OpenLab</a> - every Tuesday from 20:00</span><br>
							The open electronics lab with professional guidance and members actively working on ongoing projects. Drop by to exchange ideas with like-minded people, collaborate on projects, or learn how to solder, make things blink, or synthesize sounds.
						</li>
						<li><span class="font-bold"><a href="https://www.ccczh.ch/" target="_blank" rel="noopener noreferrer">ChaosTreff</a> - every Wednesday from 19:00</span><br>
							The open meetup of the Chaos Computer Club Zürich, celebrating the joy of tinkering and technology while keeping a keen eye on societal implications. Drop by to learn, explore, or get directly involved in technical and political projects.
						</li>
						<li><span class="font-bold"><a href="https://uwu-space.ch" target="_blank" rel="noopener noreferrer">UwU-Space</a> - every Wednesday from 19:00</span><br>
							We are a Queer Hackspace centered around Zürich. We welcome all autistic sciencing around, from tech to trains and even chemistry. We are primarily English-speaking.
						</li>
						<li><span class="font-bold"><a href="https://www.lugs.ch/lugs/" target="_blank" rel="noopener noreferrer">Linux User Group Switzerland Meetup</a> - alternating every two weeks on <a href="https://www.lugs.ch/lugs/termine/" target="_blank" rel="noopener noreferrer">Thursdays or Fridays</a> from 19:00 to 21:00</span><br>
							Meetups and talks on Linux and Open Source. The personal atmosphere makes it easy to get involved in this worldwide network. Founded in 1994, it is the first association in Switzerland dedicated exclusively to supporting Linux.
						</li>
						<li><span class="font-bold"><a href="https://www.digitale-gesellschaft.ch/" target="_blank" rel="noopener noreferrer">Digital Society</a> - Digital Rights Meetup every Thursday from 18:00</span><br>
							For exchange and further development of the topics, ideas, plans and projects of the Digital Society. Help ensure a sustainable, democratic and free civil society, and defend fundamental rights in a digitally connected world. The meetup does not take place when the "Netzpolitischer Abend" event takes place at Zentrum Karl der Grosse (usually the third Thursday of the month).
						</li>
						<li>
							<span class="font-bold"><a href="https://openstreetmap.org" target="_blank" rel="noopener noreferrer">Open Street Map</a> - Meetup on the 11th of every month from 18:30</span><br>
							At the <a href="https://wiki.openstreetmap.org/wiki/DE:Switzerland:Z%C3%BCrich/OSM-Treffen" target="_blank" rel="noopener noreferrer">Zurich OpenStreetMappers meetup</a>, people actively map, edit, verify and survey for OpenStreetMap, as well as discuss details and guidelines. No prior knowledge required!
						</li>
					</ul>
					<br>
					<p><b>Occasional / Irregular</b></p>
					<ul class="space-y-4">
						<li>In addition, there are plenty of meetings and work sessions at Bitwäscherei, as well as working group activities from the participating associations — once you join one of the public meetups, you'll quickly discover what else is going on, and before you know it, you're right in the middle of it.
						</li>
						<li>Various other events, gatherings, and workshops take place regularly ;)
						</li>
						<li>For example by the <a href="https://www.digitale-gesellschaft.ch/" target="_blank" rel="noopener noreferrer">Digital Society</a>: public workshops and talks on Digital Aikido (4x a year) and more; spring &amp; autumn gatherings (full-day, 25-30 people &amp; food), board meetings and other gatherings, and daily office use.
						</li>
					</ul>
				</div>
				<div class="w-full lg:w-1/3 mt-12 lg:mt-0">
					<h2 class="text-3xl font-bold my-4 neon">Stay informed</h2>
					<p>Connect with us through the following channels or simply drop by in person!</p>
					<p class="mt-4">Subscribe to the mailing list: <a href="https://lists.chaostreff.ch/postorius/lists/bitwascherei.chaostreff.ch/">bitwascherei@chaostreff.ch</a>
					<div class="bg-gradient-to-br from-blue-800 to-purple-800 my-3">
						<div class="p-4">
							<div class="text-2xl text-teal-200">Matrix Chat</div>
							<p class="my-4">
								We use a Matrix server as our primary messenger, where you can register an account. There are several public channels. For private channels, please ask the respective association. To reach Bitwäscherei in general, join the channel #bw-general:chab.is
							</p>
							<a class="inline-block px-6 py-2 border-2 border-teal-400 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out" href="https://plauder.chab.is" target="_blank" rel="noopener noreferrer">plauder.chab.is</a>
						</div>
					</div>
					<div class="bg-gradient-to-br from-blue-800 to-purple-800 my-6">
						<div class="p-4">
							<div class="text-2xl text-teal-200">Workadventu.re</div>
							<p class="my-4">
								Want to join an event but can't be on site? Drop in digitally via workadventu.re and chat with others via voice and video.
							</p>
							<a class="inline-block px-6 py-2 border-2 border-teal-400 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out" href="https://lab.mechatronicart.ch/" target="_blank" rel="noopener noreferrer">lab.mechatronicart.ch</a>
						</div>
					</div>
					<div class="bg-gradient-to-br from-blue-800 to-purple-800 my-6">
						<div class="p-4">
							<div class="text-2xl text-teal-200">Wiki</div>
							<p>Looking for more information about Bitwäscherei or want to get actively involved? As a member of one of the associations, you can register and have your wiki account activated.</p>
							<a class="inline-block px-6 py-2 border-2 border-teal-400 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out" href="https://wiki.digitale-gesellschaft.ch/" target="_blank" rel="noopener noreferrer">To the Wiki</a>
						</div>
					</div>
					<div class="bg-gradient-to-br from-blue-800 to-purple-800 my-6">
						<div class="p-4">
							<div class="text-2xl text-teal-200">Good to know</div>
							<ul class="ml-6 list-disc space-y-2">
								<li>If beverages are running low on site, feel free to report a shortage. A QR code / link is posted on the wall by the beverage storage.</li>
								<li>If the entrance door downstairs is locked, just call +41 44 520 98 37
									and someone will be happy to open it for you.
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="mt-12">
			<h2 class="text-3xl font-bold my-4 neon">Impressions of the Space</h2>
			<div class="container gap-2">
				<div class="flex flex-wrap -m-1 md:-m-2" id="gallery">
					<div class="flex flex-wrap w-1/2 lg:w-1/4">
						<a href="/static/img/gallery/028.jpg" class="w-full h-64 p-1 md:p-2">
							<img alt="Impressions of Bitwäscherei" class="hover:brightness-50 transition block object-cover object-center w-full h-full rounded"
								 src="/static/img/gallery/small/028.jpg">
						</a>
					</div>
					<div class="flex flex-wrap w-1/2 lg:w-1/4">
						<a href="/static/img/gallery/027.jpg" class="w-full h-64 p-1 md:p-2">
							<img alt="Impressions of Bitwäscherei" class="hover:brightness-50 transition block object-cover object-center w-full h-full rounded"
								 src="/static/img/gallery/small/027.jpg">
						</a>
					</div>
					<div class="flex flex-wrap w-1/2 lg:w-1/4">
						<a href="/static/img/gallery/026.jpg" class="w-full h-64 p-1 md:p-2">
							<img alt="Impressions of Bitwäscherei" class="hover:brightness-50 transition block object-cover object-center w-full h-full rounded"
								 src="/static/img/gallery/small/026.jpg">
						</a>
					</div>
					<div class="flex flex-wrap w-1/2 lg:w-1/4">
						<a href="/static/img/gallery/025.jpg" class="w-full h-64 p-1 md:p-2">
							<img alt="Impressions of Bitwäscherei" class="hover:brightness-50 transition block object-cover object-center w-full h-full rounded"
								 src="/static/img/gallery/small/025.jpg">
						</a>
					</div>
					<div class="flex flex-wrap w-1/2 lg:w-1/4">
						<a href="/static/img/gallery/024.jpg" class="w-full h-64 p-1 md:p-2">
							<img alt="Impressions of Bitwäscherei" class="hover:brightness-50 transition block object-cover object-center w-full h-full rounded"
								 src="/static/img/gallery/small/024.jpg">
						</a>
					</div>
					<div class="flex flex-wrap w-1/2 lg:w-1/4">
						<a href="/static/img/gallery/017.jpg" class="w-full h-64 p-1 md:p-2">
							<img alt="Impressions of Bitwäscherei" class="hover:brightness-50 transition block object-cover object-center w-full h-full rounded"
								 src="/static/img/gallery/small/017.jpg">
						</a>
					</div>
					<div class="flex flex-wrap w-1/2 lg:w-1/4">
						<a href="/static/img/gallery/018.jpg" class="w-full h-64 p-1 md:p-2">
							<img alt="Impressions of Bitwäscherei" class="hover:brightness-50 transition block object-cover object-center w-full h-full rounded"
								 src="/static/img/gallery/small/018.jpg">
						</a>
					</div>
					<div class="flex flex-wrap w-1/2 lg:w-1/4">
						<a href="/static/img/gallery/019.jpg" class="w-full h-64 p-1 md:p-2">
							<img alt="Impressions of Bitwäscherei" class="hover:brightness-50 transition block object-cover object-center w-full h-full rounded"
								 src="/static/img/gallery/small/019.jpg">
						</a>
					</div>
					<div class="flex flex-wrap w-1/2 lg:w-1/4">
						<a href="/static/img/gallery/020.jpg" class="w-full h-64 p-1 md:p-2">
							<img alt="Impressions of Bitwäscherei" class="hover:brightness-50 transition block object-cover object-center w-full h-full rounded"
								 src="/static/img/gallery/small/020.jpg">
						</a>
					</div>
					<div class="flex flex-wrap w-1/2 lg:w-1/4">
						<a href="/static/img/gallery/021.jpg" class="w-full h-64 p-1 md:p-2">
							<img alt="Impressions of Bitwäscherei" class="hover:brightness-50 transition block object-cover object-center w-full h-full rounded"
								 src="/static/img/gallery/small/021.jpg">
						</a>
					</div>
					<div class="flex flex-wrap w-1/2 lg:w-1/4">
						<a href="/static/img/gallery/022.jpg" class="w-full h-64 p-1 md:p-2">
							<img alt="Impressions of Bitwäscherei" class="hover:brightness-50 transition block object-cover object-center w-full h-full rounded"
								 src="/static/img/gallery/small/022.jpg">
						</a>
					</div>
					<div class="flex flex-wrap w-1/2 lg:w-1/4">
						<a href="/static/img/gallery/023.jpg" class="w-full h-64 p-1 md:p-2">
							<img alt="Impressions of Bitwäscherei" class="hover:brightness-50 transition block object-cover object-center w-full h-full rounded"
								 src="/static/img/gallery/small/023.jpg">
						</a>
					</div>
					<div class="flex flex-wrap w-1/2 lg:w-1/4">
						<a href="/static/img/gallery/001.jpg" class="w-full h-64 p-1 md:p-2">
							<img alt="Impressions of Bitwäscherei" class="hover:brightness-50 transition block object-cover object-center w-full h-full rounded"
								 src="/static/img/gallery/small/001.jpg">
						</a>
					</div>
					<div class="flex flex-wrap w-1/2 lg:w-1/4">
						<a href="/static/img/gallery/003.jpg" class="w-full h-64 p-1 md:p-2">
							<img alt="Impressions of Bitwäscherei" class="hover:brightness-50 transition block object-cover object-center w-full h-full rounded"
								 src="/static/img/gallery/small/003.jpg">
						</a>
					</div>
					<div class="flex flex-wrap w-1/2 lg:w-1/4">
						<a href="/static/img/gallery/004.jpg" class="w-full h-64 p-1 md:p-2">
							<img alt="Impressions of Bitwäscherei" class="hover:brightness-50 transition block object-cover object-center w-full h-full rounded"
								 src="/static/img/gallery/small/004.jpg">
						</a>
					</div>
					<div class="flex flex-wrap w-1/2 lg:w-1/4">
						<a href="/static/img/gallery/005.jpg" class="w-full h-64 p-1 md:p-2">
							<img alt="Impressions of Bitwäscherei" class="hover:brightness-50 transition block object-cover object-center w-full h-full rounded"
								 src="/static/img/gallery/small/005.jpg">
						</a>
					</div>
					<div class="flex flex-wrap w-1/2 lg:w-1/4">
						<a href="/static/img/gallery/006.jpg" class="w-full h-64 p-1 md:p-2">
							<img alt="Impressions of Bitwäscherei" class="hover:brightness-50 transition block object-cover object-center w-full h-full rounded"
								 src="/static/img/gallery/small/006.jpg">
						</a>
					</div>
					<div class="flex flex-wrap w-1/2 lg:w-1/4">
						<a href="/static/img/gallery/007.jpg" class="w-full h-64 p-1 md:p-2">
							<img alt="Impressions of Bitwäscherei" class="hover:brightness-50 transition block object-cover object-center w-full h-full rounded"
								 src="/static/img/gallery/small/007.jpg">
						</a>
					</div>
					<div class="flex flex-wrap w-1/2 lg:w-1/4">
						<a href="/static/img/gallery/008.jpg" class="w-full h-64 p-1 md:p-2">
							<img alt="Impressions of Bitwäscherei" class="hover:brightness-50 transition block object-cover object-center w-full h-full rounded"
								 src="/static/img/gallery/small/008.jpg">
						</a>
					</div>
					<div class="flex flex-wrap w-1/2 lg:w-1/4">
						<a href="/static/img/gallery/009.jpg" class="w-full h-64 p-1 md:p-2">
							<img alt="Impressions of Bitwäscherei" class="hover:brightness-50 transition block object-cover object-center w-full h-full rounded"
								 src="/static/img/gallery/small/009.jpg">
						</a>
					</div>
					<div class="flex flex-wrap w-1/2 lg:w-1/4">
						<a href="/static/img/gallery/010.jpg" class="w-full h-64 p-1 md:p-2">
							<img alt="Impressions of Bitwäscherei" class="hover:brightness-50 transition block object-cover object-center w-full h-full rounded"
								 src="/static/img/gallery/small/010.jpg">
						</a>
					</div>
					<div class="flex flex-wrap w-1/2 lg:w-1/4">
						<a href="/static/img/gallery/011.jpg" class="w-full h-64 p-1 md:p-2">
							<img alt="Impressions of Bitwäscherei" class="hover:brightness-50 transition block object-cover object-center w-full h-full rounded"
								 src="/static/img/gallery/small/011.jpg">
						</a>
					</div>
					<div class="flex flex-wrap w-1/2 lg:w-1/4">
						<a href="/static/img/gallery/012.jpg" class="w-full h-64 p-1 md:p-2">
							<img alt="Impressions of Bitwäscherei" class="hover:brightness-50 transition block object-cover object-center w-full h-full rounded"
								 src="/static/img/gallery/small/012.jpg">
						</a>
					</div>
					<div class="flex flex-wrap w-1/2 lg:w-1/4">
						<a href="/static/img/gallery/013.jpg" class="w-full h-64 p-1 md:p-2">
							<img alt="Impressions of Bitwäscherei" class="hover:brightness-50 transition block object-cover object-center w-full h-full rounded"
								 src="/static/img/gallery/small/013.jpg">
						</a>
					</div>
					<div class="flex flex-wrap w-1/2 lg:w-1/4">
						<a href="/static/img/gallery/014.jpg" class="w-full h-64 p-1 md:p-2">
							<img alt="Impressions of Bitwäscherei" class="hover:brightness-50 transition block object-cover object-center w-full h-full rounded"
								 src="/static/img/gallery/small/014.jpg">
						</a>
					</div>
					<div class="flex flex-wrap w-1/2 lg:w-1/4">
						<a href="/static/img/gallery/015.jpg" class="w-full h-64 p-1 md:p-2">
							<img alt="Impressions of Bitwäscherei" class="hover:brightness-50 transition block object-cover object-center w-full h-full rounded"
								 src="/static/img/gallery/small/015.jpg">
						</a>
					</div>
					<div class="flex flex-wrap w-1/2 lg:w-1/4">
						<a href="/static/img/gallery/016.jpg" class="w-full h-64 p-1 md:p-2">
							<img alt="Impressions of Bitwäscherei" class="hover:brightness-50 transition block object-cover object-center w-full h-full rounded"
								 src="/static/img/gallery/small/016.jpg">
						</a>
					</div>
				</div>
			</div>
		</section>

		<section class="mt-12" id="charter">
			<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
				<div>
					<h2 class="text-3xl font-bold my-4 neon">Charter</h2>
					<div class="container gap-4 space-y-4">
						<div><strong>Target</strong><br>
							The Bitwäscherei is a space for socialising and exchanging knowledge. We want to be an
							inspiring place for cultural, technological, artistic and social interaction. To this end,
							we offer a comprehensive infrastructure and help to develop and realise ideas. We work on
							hardware, digital and conceptual topics and also want to enable the realisation of unusual
							ideas.
						</div>
						<div>
							<strong>Uses</strong><br>
							The Bitwäscherei provides the framework to enable the participating organisations to use the
							space in different ways. Individual work is just as welcome as joint projects within the
							clubs and beyond. We are a community space and have no personal workplaces. We arrange our
							space in a homely way but do not live here. We offer space for experiments and creative uses
							and also want to create publicity.
						</div>
						<div>
							<strong>Interaction</strong><br>
							Be excellent to each other.
							<br><br>
							We treat each other with kindness and support. We respect our own and others' physical and
							emotional boundaries. We ensure mutual consent in our actions. In doing so, we emphasise
							freedom and personal responsibility.
							<br><br>
							We do not tolerate discrimination, violence or abusive or disrespectful behaviour in any way
							within Bitwäscherei. Anyone who engages in sexist, racist, homophobic/transphobic, ableist
							or other misanthropic behaviour must leave our space. Our Care Team is the first point of
							contact if we experience or observe problematic behaviour.
						</div>
						<div>
							<strong>Awareness</strong><br>
							We take care of each other and ourselves and live an active welcoming culture. We greet
							people who visit the Bitwäscherei for the first time in a friendly manner and explain the
							organisation of the Bitwäscherei and the rules.
							<br><br>
							We respect privacy and pay attention to balance when there is heavy use by individuals or
							when they take up an excessive amount of space (spatially and when making decisions).
						</div>
						<div>
							<strong>Accessibility</strong><br>
							Our venue is wheelchair accessible and features an accessible restroom on the ground floor.
						</div>
					</div>
				</div>
				<div>
					<h2 class="text-3xl font-bold my-4 neon">Unser Leitbild</h2>
					<div class="container gap-4 space-y-4">
						<div><strong>Ziel</strong><br>
							Die Bitwäscherei ist ein Raum um Kontakte zu knüpfen und den Austausch von Wissen zu
							ermöglichen. Wir möchten ein inspirierender Ort sein um kulturelle, technologische,
							künstlerische und soziale Interaktionen zu ermöglichen. Dazu bieten wir eine umfangreiche
							Infrastruktur und helfen Ideen zu entwickeln und umzusetzen. Wir arbeiten an Hardware,
							Digitalen sowie konzeptionellen Themen und wollen auch die Realisierung von ungewöhnlichen Ideen
							ermöglichen.
						</div>
						<div>
							<strong>Nutzungen</strong><br>
							Die Bitwäscherei bietet den Rahmen um den beteiligten Vereinen ihre unterschiedlichen
							Nutzungen zu ermöglichen. Individuelles Arbeiten ist ebenso willkommen, wie gemeinsame Projekte in den
							Vereinen und über die Vereine hinaus. Wir sind ein Community Space und haben keine
							persönlichen Arbeitsplätze. Wir richten unser Space wohnlich ein aber wohnen nicht hier. Wir bieten Raum
							für Experimente und kreative Nutzungen und möchten damit auch Öffentlichkeit schaffen.
						</div>
						<div>
							<strong>Umgang</strong><br>
							Be excellent to each other. Wir gehen wohlwollend und unterstützend miteinander um. Wir
							respektieren unsere eigenen und die physische und emotionale Grenzen anderer. Bei unseren
							Handlung stellen wir die gegenseitige Zustimmung sicher. Dabei setzen wir auf Freiheit und
							Selbstverantwortung.
							<br><br>
							Diskriminierung, Gewalt sowie übergriffiges oder respektloses Verhalten dulden wir in keiner
							Weise in der Bitwäscherei. Wer sich sexistisch, rassistisch, homo-/transfeindlich, ableistisch
							oder sonst menschenfeindlich verhält, muss unseren Space verlassen. Unser Care Team ist
							erste Anlaufstelle wenn wir problematischen Verhalten erleben oder beobachten.
						</div>
						<div>
							<strong>Achtsamkeit</strong><br>
							Wir geben aufeinander und uns selber acht und leben eine aktive Willkommenskultur. Menschen
							welche zum ersten mal die Bitwäscherei besuchen, begrüssen wir freundlich und erläutern die
							Organisation der Bitwäscherei und erklären die Regeln.
							<br><br>
							Wir respektieren die Privatsphäre und achten auf die Balance, wenn eine starke Nutzung von
							einzelnen erfolgt oder diese übermässig viel Raum einnehmen (räumlich und bei Entscheidungen).
						</div>
						<div>
							<strong>Barrierefreiheit</strong><br>
							Unser Raum ist barrierefrei und verfügt im EG über ein barrerierefreie Toilette.
						</div>
					</div>
				</div>
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
					<a data-modal="modal-one" style="cursor:pointer">Legal &amp; Privacy</a>
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
		<h1 class="text-3xl my-2">Legal Notice</h1>

		<h2 class="text-2xl my-2">Privacy Policy</h2>
		<p>Privacy is important to us. For this reason, we comply with applicable law and prioritize data minimization. Specifically:</p>
		<ul class="list-disc space-y-2 ml-4">
			<li>We only process personal data when necessary and communicate this clearly. Data is kept only for as long as needed and is never shared.</li>
			<li>We exclusively use services and servers located in Switzerland and Germany.</li>
			<li>We do not use cookies and do not store IP addresses that would allow individuals to be identified.</li>
		</ul>

		<h2 class="text-2xl my-2">Imprint</h2>
		<p>
			Verein Bitwäscherei<br>
			Neue Hard 12<br>
			8005 Zurich<br>
			Switzerland<br>
			<br>

			+41 44 520 98 37 (irregularly attended)
		</p>
	</div>
</div>

<script src="/static/js/bitw.js"></script>
</body>
</html>
