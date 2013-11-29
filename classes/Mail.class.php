<?php

class Mail {
	private $nomExpediteur;
	private $mailExpediteur;
	private $mailDestinataire;
	private $sujet;
	private $message;
	private $messageTexte;
	private $messageHTML;
	private $entete;
	private $retourChariot;
	// une frontiere(boundary) délimite differents type d'info dans le mail. 
	// Par exemple on peut faire un mail avec texte / html / image / fichier en
	// délimitant les parties du mail avec la boundary
	private $boundary;

	function __construct($nomExpediteur, $mailExpediteur, $mailDestinataire, $sujet, $messageHTML) {
		$this->nomExpediteur = $nomExpediteur;
		$this->mailExpediteur = $mailExpediteur;
		$this->mailDestinataire = $mailDestinataire;
		$this->sujet = $sujet;

		$this->messageTexte = strip_tags($messageHTML);
		$this->messageHTML = $messageHTML;

		// Définition du retour à la ligne en fonction des serveurs mails qui souffrent de bugs
		if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $this->mailDestinataire)) {
			$this->retourChariot = "\r\n";
		} else {
			$this->retourChariot = "\n";
		}

		// Définition de la boundary
		$this->boundary = "-----=" . md5(rand());

		// Création de l'entête
		$this->entete = "From: \"" . $this->nomExpediteur . "\" <" . $this->mailExpediteur . ">" . $this->retourChariot;
		$this->entete.= "Reply-to: \"" . $this->nomExpediteur . "\" <" . $this->mailExpediteur . ">" . $this->retourChariot;
		$this->entete.= "MIME-Version: 1.0" . $this->retourChariot;
		$this->entete.= "Content-Type: multipart/alternative;" . $this->retourChariot . " boundary=\"$this->boundary\"" . $this->retourChariot;

		// Création du message
		$this->message = $this->retourChariot . "--" . $this->boundary . $this->retourChariot;
		//Ajout du message au format texte.
		$this->message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"" . $this->retourChariot;
		$this->message.= "Content-Transfer-Encoding: 8bit" . $this->retourChariot;
		$this->message.= $this->retourChariot . $this->messageTexte . $this->retourChariot;

		$this->message.= $this->retourChariot . "--" . $this->boundary . $this->retourChariot;
		// Ajout du message au format HTML
		$this->message.= "Content-Type: text/html; charset=\"ISO-8859-1\"" . $this->retourChariot;
		$this->message.= "Content-Transfer-Encoding: 8bit" . $this->retourChariot;
		$this->message.= $this->retourChariot . $this->messageHTML . $this->retourChariot;
		
		$this->message.= $this->retourChariot . "--" . $this->boundary . "--" . $this->retourChariot;
		$this->message.= $this->retourChariot . "--" . $this->boundary . "--" . $this->retourChariot;
	}

	public function envoyer() {
		mail($this->mailDestinataire, $this->sujet, $this->message, $this->entete);
	}
}

// $nouveauMail = new Mail("Papy PHP", "liodu13170@gmail.com", "benegautier66@gmail.com", "Un mail envoyé avec ma classe Php Mail", "<html><head></head><body><p>Si tu as reçu ce mail c'est que ma <strong>classe Php Mail</strong> fonctionne convenablement.</p></body></html>");
// $nouveauMail->envoyer();
?>