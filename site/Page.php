<?php

class Page {
	private $db;
	private $dbfile;
	private $config = [];
	public readonly array $t;

	public function __construct(public readonly string $lang = 'de') {
		date_default_timezone_set('Europe/Zurich');
		// the container image keeps it next to the PHP files, as its config dir is a volume
		$translations = __DIR__ . '/translations.ini';
		if (!file_exists($translations)) {
			$translations = __DIR__ . '/../config/translations.ini';
		}
		$this->t = parse_ini_file($translations, true)[$lang];

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
			if (!is_writable(dirname($this->dbfile))) {
				throw new Exception(dirname($this->dbfile) . " must be writable to create the events database");
			}
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

	// only the admin page uses a session, so the public pages set no cookies
	public function login() {
		session_start();
		if (isset($_POST['password'])) {
			if ($_POST['password'] === $this->config['ADMINPASSWORD']) {
				$_SESSION['admin'] = "loggedin";
			} else {
				unset($_SESSION['admin']);
			}
		}
	}

	public function checkLogin() {
		return ($_SESSION['admin'] ?? null) === 'loggedin';
	}

	public function getEvents() {
		$stmt = $this->db->prepare("SELECT * FROM events WHERE `enddate` >= :today ORDER BY `id`");
		$stmt->execute([':today' => date("Y-m-d")]);
		return $stmt;
	}

	public function getNextEvents($limit = 10) {
		$events = [];

		$stmt = $this->db->prepare("SELECT * FROM events WHERE `enddate` >= :today ORDER BY `startdate` ASC");
		$stmt->execute([':today' => date("Y-m-d") . " 00:00:01"]);
		foreach ($stmt->fetchAll(\PDO::FETCH_ASSOC) as $event) {
			$event['startdate'] = new DateTimeImmutable($event['startdate']);
			$event['enddate'] = new DateTimeImmutable($event['enddate']);
			$events[] = $event;
		}

		$this->addWeeklyEvents($events);

		// usort is stable, so events starting at the same time keep their order
		usort($events, fn($a, $b) => $a['startdate']->getTimestamp() <=> $b['startdate']->getTimestamp());
		$events = array_slice($events, 0, $limit);

		foreach ($events as &$event) {
			$event['multiday'] = $event['startdate']->format('Y-m-d') !== $event['enddate']->format('Y-m-d');
			$event['startdate'] = $this->formatDate($event['startdate']);
			$event['enddate'] = $this->formatDate($event['enddate']);
		}
		unset($event);

		return $events;
	}

	private function addWeeklyEvents(&$events) {
		$timestamp = (date('D') == 'Tue' ? strtotime('today') : strtotime('next tuesday'));
		$date = (new DateTimeImmutable())->setTimestamp($timestamp);
		$events[] = [
			"title" => "Openlab",
			"description" => $this->t['openlab_desc'],
			"verein" => "SGMK",
			"startdate" => $date->setTime(20, 0),
			"enddate" => $date->setTime(23, 30),
		];

		$timestamp = (date('D') == 'Wed' ? strtotime('today') : strtotime('next wednesday'));
		$date = (new DateTimeImmutable())->setTimestamp($timestamp);
		$events[] = [
			"title" => "ChaosTreff",
			"description" => $this->t['chaostreff_desc'],
			"verein" => "CCCZH",
			"startdate" => $date->setTime(19, 0),
			"enddate" => $date->setTime(22, 0),
		];

		$this->addDigiGesEvents($events);
		$this->addLugsEvents($events);

		// TODO: OSM => zu unregelmässig
	}

	private function addDigiGesEvents(&$events) {
		$timestamp = (date('D') == 'Thu' ? strtotime('today') : strtotime('next thursday'));
		$date = (new DateTimeImmutable())->setTimestamp($timestamp);

		// no meetup on the third thursday of the month ("Netzpolitischer Abend")
		if ((int)ceil($date->format('j') / 7) === 3) {
			return;
		}

		$events[] = [
			"title" => $this->t['digiges_title'],
			"description" => $this->t['digiges_desc'],
			"verein" => "DigiGes",
			"startdate" => $date->setTime(18, 0),
			"enddate" => $date->setTime(22, 0),
		];
	}

	private function addLugsEvents(&$events) {
		$today = date("Y-m-d");
		$thursday = new DateTimeImmutable('2024-02-15 19:15:00');
		while($thursday->format("Y-m-d") < $today) {
			$thursday = $thursday->add(DateInterval::createFromDateString('4 week'));
		}

		$friday = new DateTimeImmutable('2024-03-01 19:15:00');
		while($friday->format("Y-m-d") < $today) {
			$friday = $friday->add(DateInterval::createFromDateString('4 week'));
		}

		$nextEventDay = min($thursday, $friday);

		$events[] = [
			"title" => $this->t['lugs_title'],
			"description" => $this->t['lugs_desc'],
			"verein" => "LUGS",
			"startdate" => $nextEventDay->setTime(19, 15),
			"enddate" => $nextEventDay->setTime(20, 45),
		];
	}

	private const WEEKDAYS = [
		'de' => [1 => 'Mo.', 'Di.', 'Mi.', 'Do.', 'Fr.', 'Sa.', 'So.'],
		'en' => [1 => 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
	];

	private const MONTHS = [
		'de' => [1 => 'Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'],
		'en' => [1 => 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
	];

	// e.g. "Mo. 5. Januar 2026 19:00 Uhr" or "Mon 5 January 2026 19:00"
	private function formatDate(DateTimeInterface $date): string {
		return self::WEEKDAYS[$this->lang][(int)$date->format('N')] . ' '
			. $date->format('j') . ($this->lang === 'de' ? '. ' : ' ')
			. self::MONTHS[$this->lang][(int)$date->format('n')] . ' '
			. $date->format('Y H:i') . $this->t['time_suffix'];
	}

	public function saveEvents() {
		$this->db->exec("delete from events");
		$sql = 'INSERT INTO events(title,startdate,enddate,description,verein) ' . 'VALUES(:title,:startdate,:enddate,:description,:verein)';
		$stmt = $this->db->prepare($sql);
		for ($i = 0; $i < count($_POST['title']); $i++) {
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