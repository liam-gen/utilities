<?php
/*---------------------------------------------------------------*/
/*
    Titre : Chercher un mot ou une phrase parmis les fichiers d'un dossier                                                                                  
                                                                                                                          
    Auteur            : liamgen.js
    Taille du fichier : 2.9 Ko
    Date édition      : 29 Janvier 2022                                                                                        
    Date mise à jour  : 29 Janvier 2022                                                                                      
    Rapport           : Fonctionnement vérifié                                                                                   
*/
/*---------------------------------------------------------------*/

// On créer la fonction str_contains si elle n'existe pas
if (!function_exists('str_contains')) {
    function str_contains(string $haystack, string $needle): bool
    {
        return '' === $needle || false !== strpos($haystack, $needle);
    }
}



// On créer la classe permettant de rechercher un mot parmis les fichiers d'un dossier
class Searcher{
	function __construct($text, $dir)
	{
    // On définis le texte à chercher
		$this->text = $text;
    // On définis l'array de retour
		$this->arr = array();
    // On lance la recherche
		$this->_get(__DIR__."/try", $text);
	}
  
  // Fonction privée pour chercher dans les fichiers
	private function _get($dir)
	{
    // On charge les fichiers
		$sd = scandir($dir);
    
    // On créer une boucle pour tout les fichiers
		foreach($sd as $fi=>$v) {
      
      // On passe si les fichiers sont inutiles
			if(in_array($v, array(".", ".."))) {continue;}
      
      // On relance la boucle si c'est un dossier
			if(is_dir($dir."/".$v)) {$this->_get($dir."/".$v); }
      
      // On ouvre le fichier pour le lire
			if ($file = fopen($dir."/".$v, "r")) {
        
        // On lit ligne par ligne pour approfondir la recherche
				while(!feof($file)) {
          
          // On obtient le texte de la ligne
					$textperline = fgets($file);
          
          // Si il y a le texte rechercher dans la ligne et que le fichier n'est pas déjà dans l'array , on ajoute le fichier à l'array
					if(str_contains($textperline, $this->text) and !in_array($d."/".$v, $this->arr))
					{
						 $this->arr[] = $dir."/".$v;
					}
				 }
        // On ferme le fichier
			fclose($file);
			}
		}
	}
	
  // FOnction pubique pour retourner la réponse
	public function get()
	{
		return $this->arr;
	}
}

// Le text qu'on cherche & le répertoire dans lequel on va chercher parmis les fichiers
$txt = "Hello World";
$dir = "/mon_repertoire";


// Retourne un array avec le nom de tous les fichiers : Array([0] => /file.txt)
$s = new Searcher($text, __DIR__.$dir);
print_r($s->get());
?>
