<?php
// Klasa za rukovanje e-mail porukama
class EmailMessage
{

	// Veza sa IMAP serverom
	protected $connection;
	// Broj poruke u okviru poštanskog sandučeta
	protected $messageNumber;

	// Sadržaj poruke u HTML formatu
	public $bodyHTML = '';
	// Sadržaj poruke u običnom tekstualnom formatu
	public $bodyPlain = '';
	// Lista priloga iz poruke
	public $attachments;

	// Opcija koja određuje da li će se prilozi preuzimati
	public $getAttachments = true;

	// Konstruktor klase: postavlja vezu i broj poruke
	public function __construct($connection, $messageNumber)
	{
		$this->connection = $connection;
		$this->messageNumber = $messageNumber;
	}

	// Metoda za preuzimanje strukture poruke
	public function fetch()
	{
		$structure = @imap_fetchstructure($this->connection, $this->messageNumber);
		if (!$structure) {
			return false; // Ako struktura nije dostupna, vraća false
		} else {
			$this->recurse($structure->parts); // Analizira delove poruke
			return true;
		}
	}

	// Rekurzivna metoda za obradu delova poruke
	public function recurse($messageParts, $prefix = '', $index = 1, $fullPrefix = true)
	{
		foreach ($messageParts as $part) {
			// Generisanje broja dela poruke
			$partNumber = $prefix . $index;

			// Ako je deo tipa tekst (PLAIN ili HTML)
			if ($part->type == 0) {
				if ($part->subtype == 'PLAIN') {
					$this->bodyPlain .= $this->getPart($partNumber, $part->encoding);
				} else {
					$this->bodyHTML .= $this->getPart($partNumber, $part->encoding);
				}
			}
			// Ako je deo poruke druge vrste (npr. poruka u poruci)
			elseif ($part->type == 2) {
				$msg = new EmailMessage($this->connection, $this->messageNumber);
				$msg->getAttachments = $this->getAttachments;
				$msg->recurse($part->parts, $partNumber . '.', 0, false);
				$this->attachments[] = array(
					'type' => $part->type,
					'subtype' => $part->subtype,
					'filename' => '',
					'data' => $msg,
					'inline' => false,
				);
			}
			// Ako deo ima svoje poddelove
			elseif (isset($part->parts)) {
				if ($fullPrefix) {
					$this->recurse($part->parts, $prefix . $index . '.');
				} else {
					$this->recurse($part->parts, $prefix);
				}
			}
			// Ako je deo tipa prilog
			elseif ($part->type > 2) {
				if (isset($part->id)) {
					$id = str_replace(array('<', '>'), '', $part->id);
					$this->attachments[$id] = array(
						'type' => $part->type,
						'subtype' => $part->subtype,
						'filename' => $this->getFilenameFromPart($part),
						'data' => $this->getAttachments ? $this->getPart($partNumber, $part->encoding) : '',
						'inline' => true,
					);
				} else {
					$this->attachments[] = array(
						'type' => $part->type,
						'subtype' => $part->subtype,
						'filename' => $this->getFilenameFromPart($part),
						'data' => $this->getAttachments ? $this->getPart($partNumber, $part->encoding) : '',
						'inline' => false,
					);
				}
			}

			$index++;
		}
	}

	// Metoda za preuzimanje sadržaja dela poruke
	function getPart($partNumber, $encoding)
	{
		$data = imap_fetchbody($this->connection, $this->messageNumber, $partNumber);
		switch ($encoding) {
			case 0:
				return $data; // 7BIT kodiranje
			case 1:
				return $data; // 8BIT kodiranje
			case 2:
				return $data; // BINARY kodiranje
			case 3:
				return base64_decode($data); // BASE64 kodiranje
			case 4:
				return quoted_printable_decode($data); // QUOTED_PRINTABLE kodiranje
			case 5:
				return $data; // OSTALO
		}
	}

	// Metoda za preuzimanje imena fajla iz dela poruke
	function getFilenameFromPart($part)
	{
		$filename = '';

		// Provera dparameters za atribut "filename"
		if ($part->ifdparameters) {
			foreach ($part->dparameters as $object) {
				if (strtolower($object->attribute) == 'filename') {
					$filename = $object->value;
				}
			}
		}

		// Provera parameters za atribut "name" ako filename nije pronađen
		if (!$filename && $part->ifparameters) {
			foreach ($part->parameters as $object) {
				if (strtolower($object->attribute) == 'name') {
					$filename = $object->value;
				}
			}
		}

		return $filename;
	}
}
