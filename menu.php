<?php 

function displayMenu($page) 
{
	$home = '';
	$news = '';
	$profil = '';
	$register = '';
	switch ($page) {
		case 'home':
			$home = ' class="active"';
			break;
		case 'news':
			$news = ' class="active"';
			break;
		case 'profil':
			$profil = ' class="active"';
			break;
		case 'register':
			$register = ' class="active"';
			break;		
		default:
			break;
	}
	echo '
		<nav class="menu">
			<input type="checkbox" id="check">
			<label for="check" class="checkbtn">
				<i class="fas fa-bars"></i>
			</label>
			<label class="logo">Projet CSI | News en ligne</label>
			<ul>
				<li><a href="index.php"'.$home.'>Accueil</a></li>
				<li><a href="news.php"'.$news.'>News</a></li>
				<li><a href="profil.php"'.$profil.'>Profil</a></li>
				<li><a href="register_loginPage.php"'.$register.'>S\'inscrire/Se connecter</a></li>
			</ul>
		</nav>
		<br/>
	';

    // ajouter pages archives et option se déconnecter quand utilisateur est bien connecté
}
