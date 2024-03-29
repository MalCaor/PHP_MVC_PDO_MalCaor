<?php
class controleur {

	private $vpdo;
	private $db;
	public function __construct() {
		$this->vpdo = new mypdo ();
		$this->db = $this->vpdo->connexion;
	}
	public function __get($propriete) {
		switch ($propriete) {
			case 'vpdo' :
				{
					return $this->vpdo;
					break;
				}
			case 'db' :
				{

					return $this->db;
					break;
				}
		}
	}
	public function retourne_article($title)
	{

		$retour='<section>';
		$result = $this->vpdo->liste_article($title);
		if ($result != false) {
			while ( $row = $result->fetch ( PDO::FETCH_OBJ ) )
			// parcourir chaque ligne sélectionnée
			{

				$retour = $retour . '<div class="card text-white bg-dark m-2" ><div class="card-body">
				<article>
					<h3 class="card-title">'.$row->h3.'</h3>
					<p class="card-text">'.$row->corps.'</p>
					<p class="card-text">'.$row->nom." ".$row->prenom.'</p>
				</article>
				</div></div>';
			}
		$retour = $retour .'</section>';
		return $retour;
		}
	}


	public function genererMDP ($longueur = 8){
		// initialiser la variable $mdp
		$mdp = "";

		// Définir tout les caractères possibles dans le mot de passe,
		// Il est possible de rajouter des voyelles ou bien des caractères spéciaux
		$possible = "2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ&#@$*!";

		// obtenir le nombre de caractères dans la chaîne précédente
		// cette valeur sera utilisé plus tard
		$longueurMax = strlen($possible);

		if ($longueur > $longueurMax) {
			$longueur = $longueurMax;
		}

		// initialiser le compteur
		$i = 0;

		// ajouter un caractère aléatoire à $mdp jusqu'à ce que $longueur soit atteint
		while ($i < $longueur) {
			// prendre un caractère aléatoire
			$caractere = substr($possible, mt_rand(0, $longueurMax-1), 1);

			// vérifier si le caractère est déjà utilisé dans $mdp
			if (!strstr($mdp, $caractere)) {
				// Si non, ajouter le caractère à $mdp et augmenter le compteur
				$mdp .= $caractere;
				$i++;
			}
		}

		// retourner le résultat final
		return $mdp;
	}
	/****************************************** Affichage du slider de Menu ***************************/
public function affiche_slider() {
	return '

	<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100 item" src="image\france\data1\images de base\Cirque-de-gavarnie-Classic-.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100 item" src="image\france\data1\images de base\louvre.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100 item" src="image\france\data1\images de base\etretat.jpg" alt="Third slide">
    </div>
  </div>
</div>
	';
}
public function dataTable(){
	return'
	<div class="table-responsive">
	<table id="dataTable" class="table-striped table-bordered" cellspacing="0">
	<thead>
    <tr>
			<th>Code département</th>
			<th>Département</th>
			<th>Région</th>
    </tr>
	</thead>
	<tbody>
'.$this->codeDep().'
	</tbody>
</table>
</div>
	';
}

public function codeDep(){
	$retour = "";
	$result = $this->vpdo->liste_dep();
	if ($result != false) {
		while ( $row = $result->fetch ( PDO::FETCH_OBJ ) )
		// parcourir chaque ligne sélectionnée
		{

			$retour = $retour . '
			<tr>
				<td>'.$row->departement_code.'</td>
				<td>'.$row->departement_nom.'</td>
				<td>'.$row->libel.'</td>
			</tr>
			';
		}
		return $retour;
	}
}

public function affiche_combo_departement(){
	$vretour = '</br><select id="list_dep" onChange="js_change_dep()">';
	$result = $this->vpdo->liste_dep();
		if ($result != false) {
			while ( $row = $result->fetch ( PDO::FETCH_OBJ ) )
			// parcourir chaque ligne sélectionnée
			{

				$vretour = $vretour . '
					<option value='.$row->departement_code.'>'.$row->departement_nom.'</option>';
			}
	return $vretour.'</select>';
		}
	}

public function affiche_combo_ville(){
	$vretour = '</br><select id="list_ville"  onChange="js_change_ville()"></select>';
	return $vretour;

	}

public function affiche_info_ville(){
	$vretour = '<div id="info_ville">
								ville_departement :<input type="text" id="ville_departement" readonly></imput></br>
								ville_code_postal :<input type="text" id="ville_code_postal" readonly></imput></br>
								ville_nom_reel :<input type="text" id="ville_nom_reel" readonly></imput></br>
								ville_latitude_deg :<input type="text" id="ville_latitude_deg" readonly></imput></br>
								ville_longitude_deg :<input type="text" id="ville_longitude_deg" readonly></imput></br>
							</div>
							<div id="map" class="map"></div>';
	return $vretour;
}

// Connexion
public function retourne_formulaire_login(){
		$retour = '
		<div class="modal fade" id="myModal" role="dialog" style="color:#000;">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
        				<h4 class="modal-title"><span class="fas fa-lock"></span> Formulaire de connexion</h4>
        				<button type="button" onClick="hd();" class="close" data-dismiss="modal" aria-label="Close" ">
          					<span aria-hidden="true">&times;</span>
        				</button>
      				</div>
					<div class="modal-body">
						<form role="form" id="login" method="post">
							<div class="form-group">
								<label for="id"><span class="fas fa-user"></span> Identifiant</label>
								<input type="text" class="form-control" id="id" name="id" placeholder="Identifiant">
							</div>
							<div class="form-group">
								<label for="mp"><span class="fas fa-eye"></span> Mot de passe</label>
								<input type="password" class="form-control" id="mp" name="mp" placeholder="Mot de passe">
							</div>
							<div class="form-group" name="radioLog">
								<label class="radio-inline"><input type="radio" name="rblogin" id="rbj" value="rbj">Journaliste</label>
								<label class="radio-inline"><input type="radio" name="rblogin" id="rbr" value="rbr">Rédacteur en chef</label>
								<label class="radio-inline"><input type="radio" name="rblogin" id="rba" value="rba">Administrateur</label>
							</div>
							<button type="submit" class="btn btn-success btn-block" class="submit"><span class="fas fa-power-off"></span> Login</button>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" onClick="hd();"  class="btn btn-danger btn-default pull-left" data-dismiss="modal" ><span class="fas fa-times"></span> Cancel</button>
					</div>
				</div>
			</div>
		</div>';

		return $retour;
	}

	public function retourne_modal_message()
	{

		$retour='
		<div class="modal fade" id="ModalRetour" role="dialog" style="color:#000;">
			<div class="modal-dialog">
				<div class="modal-content">
				<div class="modal-header">
        				<h4 class="modal-title"><span class="fas fa-info-circle"></span> INFORMATIONS</h4>
        				<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="hd();">
          					<span aria-hidden="true">&times;</span>
        				</button>
      				</div>
		       		<div class="modal-body">
						<div class="alert alert-info">
							<p></p>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" onclick="hdModalRetour();">Close</button>
					</div>
				</div>
			</div>
		</div>
		';
		return $retour;
	}

	//retourne tous les articles des journalistes
	public function retourne_article_journalist(){
		$retour='<script>$(document).ready(function() {$("#tart").dataTable();} )</script>
						<div class="table-responsive">
						<table id="tart" class="table table-striped table-bordered" cellspacing="0" >
						<thead><tr>
							<th>Titre article</th>
							<th>Page</th>
							<th>Date deb</th>
							<th>Date fin</th>
							<th></th>
						</tr></thead><tbody>';
	  $result = $this->vpdo->liste_article_journaliste();
		if ($result != false) {
			while ( $row = $result->fetch ( PDO::FETCH_OBJ ) )
			// parcourir chaque ligne sélectionnée
			{
				$retour = $retour . '
				<tr>
					<td>'.$row->h3.'</td>
					<td>'.$row->title.'</td>
					<td>'.$row->date_deb.'</td>
					<td>'.$row->date_fin.'</td>
					<td style="text-align: center;">
					<button type="button"" class="btn btn-primary btn-default pull-center" onclick="modif_article('.$row->id.');">
					<span class=" fas fa-edit "></span>
					</button></td>
				</tr>';
			}

		}
		$retour = $retour .'</tbody></table></div>';
		return $retour;
	}
}
?>
