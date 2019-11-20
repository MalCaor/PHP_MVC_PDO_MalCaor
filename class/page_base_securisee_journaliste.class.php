<?php
class page_base_securisee_journaliste extends page_base {

	public function __construct() {
		parent::__construct();
	}
	public function affiche() {
				parent::affiche();
	}
	public function affiche_menu() {

		parent::affiche_menu();
		if (isset($_SESSION['id']) || isset($_SESSION['type']))
		{
		?>
		<ul>
			<li><a href="" >Gestion Article</a>
				<ul>
					<li><a href="">Proposer un article</a></li>
					<li><a href="">Modifier un article</a></li>
				</ul>
			</li>
		</ul>
		<?php
	}

	}
}
?>
