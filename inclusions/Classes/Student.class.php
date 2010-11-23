<?php

/* SupinfoLille20103.fr - Classe Student
 * 		Permet de créer un student avec toutes ses infos
 *  
 * @Attributs :
 *		$sgbd | private | type de SGBD (mysql, oracle, etc...)
 *		$idBooster | private | ID Booster
 *	 	$promo | private | Promotion (B1 | B2 | B3 | M1 | M2)
 *	 	$pass | private | Mot de passe en MD5
 *	 	$prenom | private | Prenom
 *	 	$nom | private | Nom
 *	 	$portable | private | numero de portable 
 *	 	$msn | private | identifiant MSN
 *	 	$skype | private | identifiant Skype
 *	 	$twitter | private | compte Twitter
 *	 	$facebook | private | compte Facebook
 *	 	$autorisation | private | Booleen pour l'acces au site (0=Bloque | 1=Student | 2=Admin)
 *	 	$visites | private | Nombre de visite
 *	 	$derniere_visite | private | Date de la derniere visite
 *
 * @Methodes :
 *		__construct() | public | initialise les attributs lors de la creation d'un objet
 *
 */

class Student
{

/* ************ Attributs ************ */

	private $idBooster;
	private $promo;
	private $pass;
	private $prenom;
	private $nom;
	private $portable;
	private $msn;
	private $skype;
	private $twitter;
	private $facebook;
	private $autorisation;
	private $visites;
	private $derniere_visite;
	
/* ************ __construct() ************ */
	
	public function __construct($p_idBooster){
		$this->idBooster = $p_idBooster;
		
		$BDD = new BDD();
		
		$student = $BDD->select(
			"student_promo, student_pass, student_prenom, student_nom, student_portable, student_msn, student_skype, student_twitter, student_facebook, student_autorisation, student_visites, DATE_FORMAT(student_derniere_visite,'Le %d/%m/%y') AS sdt_derniere_visite",
			"TB_STUDENTS",
			"WHERE student_idbooster = ?",
			array($this->idBooster)
		);
		
		$this->promo = $student[0]->student_promo;
		$this->pass = $student[0]->student_pass;
		$this->prenom = $student[0]->student_prenom;
		$this->nom = $student[0]->student_nom;
		$this->portable = $student[0]->student_portable;
		$this->msn = $student[0]->student_msn;
		$this->skype = $student[0]->student_skype;
		$this->twitter = $student[0]->student_twitter;
		$this->facebook = $student[0]->student_facebook;
		$this->autorisation = $student[0]->student_autorisation;
		$this->visites = $student[0]->student_visites;
		$this->derniere_visite = $student[0]->sdt_derniere_visite;
	}
	
/* ************ Getters + Setters ************ */

	public function getIdBooster() { return $this->idBooster; } 
	public function getPromo() { return $this->promo; } 
	public function getPass() { return $this->pass; } 
	public function getPrenom() { return $this->prenom; } 
	public function getNom() { return $this->nom; } 
	public function getPortable() { return $this->portable; } 
	public function getMsn() { return $this->msn; } 
	public function getSkype() { return $this->skype; } 
	public function getTwitter() { return $this->twitter; } 
	public function getFacebook() { return $this->facebook; } 
	public function getAutorisation() { return $this->autorisation; } 
	public function getVisites() { return $this->visites; } 
	public function getDerniere_visite() { return $this->derniere_visite; } 
	public function setIdBooster($x) { $this->idBooster = $x; } 
	public function setPromo($x) { $this->promo = $x; } 
	public function setPass($x) { $this->pass = $x; } 
	public function setPrenom($x) { $this->prenom = $x; } 
	public function setNom($x) { $this->nom = $x; } 
	public function setPortable($x) { $this->portable = $x; } 
	public function setMsn($x) { $this->msn = $x; } 
	public function setSkype($x) { $this->skype = $x; } 
	public function setTwitter($x) { $this->twitter = $x; } 
	public function setFacebook($x) { $this->facebook = $x; } 
	public function setAutorisation($x) { $this->autorisation = $x; } 
	public function setVisites($x) { $this->visites = $x; } 
	public function setDerniere_visite($x) { $this->derniere_visite = $x; }
		
}

?>