<?php
/**
 * Klasa za obavljanje osnovnih CRUD operacija u bazi podataka
 * @usage
 * $crud = new CRUD();
 */

class CRUD extends PDO
{
	// Izabrana tabela koja se koristi za upite
	public $table = null;

	// Konstruktor: kreira konekciju sa bazom podataka
	public function __construct($db_type = 'mysql', $db_name = 'unisell', $db_host = '127.0.0.1', $db_user = 'root', $db_pword = '', $db_charset = 'UTF8')
	{
		try {
			$dsn = "$db_type:dbname=$db_name;host=$db_host;charset=$db_charset";
			parent::__construct($dsn, $db_user, $db_pword);
			$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Postavlja način rukovanja greškama
			$this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // Postavlja podrazumevani način dohvatanja podataka
		} catch (PDOException $e) {
			die('Greška u konekciji sa bazom podataka : ' . $e->getMessage());
		}
	}

	/**
	 * Selektuje podatke iz baze
	 * 
	 * @param string|array $columns Kolone koje treba selektovati
	 * @param string|array|null $where Uslov za selektovanje podataka
	 * @param string $custom Poseban upit ako je definisan
	 * @return array Vraća niz rezultata
	 */
	public function select($columns, $where = null, $custom = '')
	{
		$this->_isTableSet();

		if (is_array($columns)) {
			$columns = implode(',', $columns); // Pretvara niz kolona u string
		}

		// Izgradnja WHERE dela upita
		$where_stmt = $this->_whereBuilder($where);

		$sth = $this->prepare("SELECT $columns FROM `{$this->table}`  $where_stmt");

		// Ako je definisan poseban upit, koristi ga
		if ($custom != '') {
			$sth = $this->prepare($custom);
		}

		$sth->execute($where);
		return $sth->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * Ubacuje nove podatke u bazu
	 * 
	 * @param array $data Asocijativni niz [kolona => vrednost]
	 * @return bool|string Vraća ID poslednjeg unosa ili false
	 */
	public function insert($data)
	{
		$this->_isTableSet();

		$keys_array = array_keys($data);
		$keys = "`" . implode('`, `', $keys_array) . "`";
		$params = ":" . implode(', :', $keys_array);

		$sth = $this->prepare("INSERT INTO `{$this->table}` ($keys) VALUES($params)");
		$result = $sth->execute($data);

		if ($result == 1) {
			return $this->lastInsertId(); // Vraća ID poslednjeg unosa
		}
		return false;
	}

	/**
	 * Ažurira postojeće podatke u bazi
	 * 
	 * @param array $data Asocijativni niz [kolona => vrednost]
	 * @param mixed $where Uslov za ažuriranje (array ili ID)
	 * @param bool $log Ažurira samo poslednji ID ako je true
	 */
	public function update($data, $where, $log = false)
	{
		$this->_isTableSet();

		$set = '';
		foreach ($data as $_key => $_value) {
			$set .= "`$_key` = :$_key,";
		}
		$set = rtrim($set, ","); // Uklanja poslednji zarez

		// Izgradnja WHERE dela upita
		$where_stmt = $this->_whereBuilder($where);

		$data = array_merge($data, $where);

		if ($log == true) {
			$sth = $this->prepare("UPDATE `{$this->table}` SET $set $where_stmt ORDER BY {$this->table}_id DESC LIMIT 1;");
		} else {
			$sth = $this->prepare("UPDATE `{$this->table}` SET $set $where_stmt");
		}

		$sth->execute($data);
	}

	/**
	 * Briše podatke iz baze na osnovu uslova
	 * 
	 * @param array $where Uslov za brisanje
	 */
	public function delete($where)
	{
		$this->_isTableSet();

		// Izgradnja WHERE dela upita
		$where_stmt = $this->_whereBuilder($where);

		$sth = $this->prepare("DELETE FROM `{$this->table}` $where_stmt");
		$sth->execute($where);
	}

	/**
	 * Privatna metoda za izgradnju WHERE dela upita
	 * 
	 * @param mixed $where Uslov za WHERE deo upita (array ili ID)
	 * @return string Generisani WHERE deo upita
	 */
	private function _whereBuilder($where)
	{
		$where_stmt = null;
		if (is_numeric($where)) {
			// Ako je prosleđen ID kao uslov
			$primary = $this->table . '_id';
			$where_stmt = "WHERE `$primary` = :primary_key";
			$where = [
				'primary_key' => $where
			];
		} elseif (is_array($where)) {
			// Ako je prosleđen niz kao uslov
			$where_stmt = '';
			foreach ($where as $_key => $_value) {
				$where_stmt .= "`$_key` = :$_key AND ";
			}
			$where_stmt = "WHERE " . rtrim($where_stmt, ' AND ');
		}

		return $where_stmt;
	}

	/**
	 * Privatna metoda za proveru da li je tabela postavljena
	 */
	private function _isTableSet()
	{
		if ($this->table == null) {
			die('Morate odabrati tabelu! Tabela nije izabrana!');
		}
	}
}
