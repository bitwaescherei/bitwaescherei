<?php

class Page {
	private $db;
	private $dbfile;
	private $config = [];

	public function __construct() {
		session_start();
		date_default_timezone_set('Europe/Zurich');

		$this->dbfile = __DIR__ . "/../config/events.sqlite3";
		$this->selfcheck();
		$this->db = new \PDO("sqlite:" . $this->dbfile);
	}

	private function selfcheck() {
		$configFile = __DIR__ . "/../config/.env";
		if (!file_exists($configFile)) {
			throw new Exception("Config-File not found");
		}

		$this->config = parse_ini_file($configFile);
		if (empty($this->config['ADMINPASSWORD'])) {
			throw new Exception("ADMINPASSWORD missing in .env");
		}

		if (!file_exists($this->dbfile)) {
			$db = new \PDO("sqlite:" . $this->dbfile);
			$db->exec("CREATE TABLE IF NOT EXISTS events(
			   id INTEGER PRIMARY KEY AUTOINCREMENT, 
			   title VARCHAR(255) NOT NULL DEFAULT '',
			   url VARCHAR(255) NOT NULL DEFAULT '',
			   verein VARCHAR(255) NOT NULL DEFAULT '',
			   description TEXT NOT NULL DEFAULT '0',
			   startdate DATETIME NOT NULL,
			   enddate DATETIME NOT NULL
			)");
		}
	}

	public function login() {
		if (isset($_POST['password'])) {
			if ($_POST['password'] === $this->config['ADMINPASSWORD']) {
				$_SESSION['admin'] = "loggedin";
			} else {
				unset($_SESSION['admin']);
			}
		}
	}

	public function checkLogin() {
		return ($_SESSION['admin'] === "loggedin");
	}

	public function getEvents() {
		return $this->db->query("SELECT * FROM events WHERE `enddate` >= '".date("Y-m-d")."' ORDER BY `id`");
	}
	public function getNextEvents($limit = 10, $locale = 'de') {
		$events = [];

		foreach ($this->db->query("select * from events where enddate >= '" . date("Y-m-d") . " 00:00:01' ORDER BY `startdate` ASC")->fetchAll() as $key => $event) {
			$newKey = strtotime($event['startdate']) ."-". $key;
			$events[$newKey] = $event;
			$startdate = new DateTime($event['startdate'], new DateTimeZone('Europe/Zurich'));
			$events[$newKey]['startdate'] = IntlDateFormatter::formatObject($startdate, 'eee d MMMM y HH:mm', $locale);

			$enddate = new DateTime($event['enddate'], new DateTimeZone('Europe/Zurich'));
			$events[$newKey]['enddate'] = IntlDateFormatter::formatObject($enddate, 'eee d MMMM y HH:mm', $locale);
		}

		$this->addWeeklyEvents($events, $locale);
		ksort($events);

		$events = array_chunk($events, $limit);

		return $events[0] ?? [];
	}

	private function addWeeklyEvents(&$events, $locale = 'de') {
		$timestamp = (date('D') == 'Tue' ? strtotime('today') : strtotime('next tuesday'));
		$events[$timestamp] = [
			"title" => "Openlab",
			"description" => $locale === 'en'
				? "The open electronics lab with professional guidance and members actively working on ongoing projects. Drop by to exchange ideas with like-minded people, collaborate on projects, or learn how to solder, make things blink, or synthesize sounds."
				: "Das offenes Elektroniklabor mit fachlicher Leitung, aktive Arbeit der Mitglieder an laufenden Projekten. Komm vorbei um Dich mit Gleichgesinnten auszutauschen, an laufenden Projekte mitzuwirken oder auch um z.B. zu lernen, wie man lötet, etwas zum blinken oder Geräusche machen bringt.",
			"verein" => "SGMK",
			"startdate" => $this->getDate($timestamp, $locale) . " 20:00",
			"enddate" => $this->getDate($timestamp, $locale) . " 23:30",
		];

		$timestamp = (date('D') == 'Wed' ? strtotime('today') : strtotime('next wednesday'));
		$events[$timestamp] = [
			"title" => "ChaosTreff",
			"description" => $locale === 'en'
				? "The open meetup of the Chaos Computer Club Zürich, celebrating the joy of tinkering and technology while keeping a keen eye on societal implications. Drop by to learn, explore, or get directly involved in technical and political projects."
				: "Das offene Treffen des Chaos Computer Club Zürich, bei dem der Spass am Gerät grossgeschrieben wird, ohne aber den gesellschaftlichen Blick zu verlieren. Komm vorbei um verstehen zu lernen, oder aber beteilige Dich direkt an technischen und politischen Projekten.",
			"verein" => "CCCZH",
			"startdate" => $this->getDate($timestamp, $locale) . " 19:00",
			"enddate" => $this->getDate($timestamp, $locale) . " 22:00",
		];

		$this->addDigiGesEvents($events, $locale);
		$this->addLugsEvents($events, $locale);

		// TODO: RL => zu unregelmässig
		// TODO: OSM => zu unregelmässig

	}

	private function addDigiGesEvents(&$events, $locale = 'de') {
		$timestamp = (date('D') == 'Thu' ? strtotime('today') : strtotime('next thursday'));
		$date = new DateTime();
		$date->setTimestamp($timestamp);
		$nextEventMonth = IntlDateFormatter::formatObject($date, 'M', 'de');
		$date->sub(DateInterval::createFromDateString('1 week'));
		$thirdThursdayInMonth = FALSE;
		if($nextEventMonth == IntlDateFormatter::formatObject($date, 'M', 'de')) {
			$date->sub(DateInterval::createFromDateString('1 week'));
			if($nextEventMonth == IntlDateFormatter::formatObject($date, 'M', 'de')) {
				$date->sub(DateInterval::createFromDateString('1 week'));
				if($nextEventMonth != IntlDateFormatter::formatObject($date, 'M', 'de')) {
					$thirdThursdayInMonth = TRUE;
				}
			}
		}

		if(!$thirdThursdayInMonth) {
			$events[$timestamp] = [
				"title" => $locale === 'en' ? "Digital Rights Meetup" : "Netzpolitik-Treff",
				"description" => $locale === 'en'
					? "for exchange and further development of the topics, ideas, plans and projects of the Digital Society. Help ensure a sustainable, democratic and free civil society, and defend fundamental rights in a digitally connected world. The meetup does not take place when the \"Netzpolitischer Abend\" event takes place at Zentrum Karl der Grosse (usually the third Thursday of the month)."
					: "für Austausch und Weiterentwicklung der Themen, Ideen, Plänen und Projekte der Digitalen Gesellschaft. Hilf mit, für eine nachhaltige, demokratische und freie Zivilgesellschaft zu sorgen, und verteidige die Grundrechte in einer digital vernetzten Welt. Der «Netzpolitische Treff» findet jeweils nicht statt, wenn der Event \"Netzpolitischer Abend\" im Zentrum Karl der Grosse stattfindet (üblicherweise am dritten Donnerstag im Monat)",
				"verein" => "DigiGes",
				"startdate" => $this->getDate($timestamp, $locale) . " 18:00",
				"enddate" => $this->getDate($timestamp, $locale) . " 22:00",
			];
		}
	}

	private function addLugsEvents(&$events, $locale = 'de') {
		$today = date("Y-m-d");
		$timestamp = strtotime('2024-02-15 19:15:00');
		$thursday = new DateTime();
		$thursday->setTimestamp($timestamp);
		while($thursday->format("Y-m-d") < $today) {
			$thursday->add(DateInterval::createFromDateString('4 week'));
		}

		$timestamp = strtotime('2024-03-01 19:15:00');
		$friday = new DateTime();
		$friday->setTimestamp($timestamp);
		while($friday->format("Y-m-d") < $today) {
			$friday->add(DateInterval::createFromDateString('4 week'));
		}

		$nextEventDay = min($thursday, $friday);

		$events[$nextEventDay->getTimestamp()] = [
			"title" => $locale === 'en' ? "LUGS Meetup" : "LUGS-Treff",
			"description" => $locale === 'en'
				? "Meetups and talks on Linux and Open Source. The personal atmosphere makes it easy to get involved in this worldwide network. Founded in 1994, it is the first association in Switzerland dedicated exclusively to supporting Linux."
				: "Treffen und Vorträge rund um Linux und Open Source. Durch den persönlichen Charakter wird der Einstieg in dieses weltweite Netzwerk leichter. 1994 gegründet und ist die erste Vereinigung der Schweiz, die sich ausschliesslich zur Aufgabe gemacht hat, Linux zu unterstützen.",
			"verein" => "LUGS",
			"startdate" => IntlDateFormatter::formatObject($nextEventDay, 'eee d MMMM y', $locale) . " 19:15",
			"enddate" => IntlDateFormatter::formatObject($nextEventDay, 'eee d MMMM y', $locale) . " 20:45",
		];
	}

	private function getDate($timestamp, $locale = 'de') {
		$date = new DateTime();
		$date->setTimestamp($timestamp);
		return IntlDateFormatter::formatObject($date, 'eee d MMMM y', $locale);
	}

	public function saveEvents() {
		$this->db->exec("delete from events");
		$sql = 'INSERT INTO events(title,startdate,enddate,description,verein) ' . 'VALUES(:title,:startdate,:enddate,:description,:verein)';
		$stmt = $this->db->prepare($sql);
		for ($i = 0; $i <= count($_POST['title']); $i++) {
			if(empty($_POST['title'][$i])) continue;
			$stmt->execute([
				':title' => htmlspecialchars(strip_tags($_POST['title'][$i])),
				':startdate' => htmlspecialchars(strip_tags($_POST['startdate'][$i])),
				':enddate' => htmlspecialchars(strip_tags($_POST['enddate'][$i])),
				':description' => htmlspecialchars(strip_tags($_POST['description'][$i])),
				':verein' => htmlspecialchars(strip_tags($_POST['verein'][$i])),
			]);
		}
	}
}