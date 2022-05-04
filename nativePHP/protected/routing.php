<?php 
if(!array_key_exists('P', $_GET) || empty($_GET['P']))
$_GET['P'] = 'home';

	switch ($_GET['P']) 
    {
		case 'login': !isUserLoggedIn() ? require_once PROTECTED_DIR.'user/login.php' : header('Location: index.php'); break;
        case 'register': !isUserLoggedIn() ? require_once PROTECTED_DIR.'user/register.php' : header('Location: index.php'); break;
		case 'home':  require_once PROTECTED_DIR.'home.php'; break;
		case 'logout': userLogout(); break;
		
		case 'seeAllFilm' : require_once PROTECTED_DIR.'film/allFilm.php'; break;
		case 'addNewFilm' : require_once PROTECTED_DIR.'film/addFilm.php'; break;


		case 'seeAllSeries' : require_once PROTECTED_DIR.'series/allSeries.php'; break;
		case 'addNewSeries' : require_once PROTECTED_DIR.'series/addSeries.php'; break;
		case 'addNewEpisode' : require_once PROTECTED_DIR.'series/addEpisode.php'; break;
		case 'seeEpisodes' : require_once PROTECTED_DIR.'series/seeEpisodes.php'; break;

		case 'search' : require_once PROTECTED_DIR.'search.php'; break;
		
		case 'addCategoryFromFile': isUserLoggedIn() && $_SESSION['permission']  > 0 ? require_once PROTECTED_DIR.'admin/updateFromFile.php' : header('Location: index.php'); break;

		case 'addCategory': isUserLoggedIn() && $_SESSION['permission']  > 0 ? require_once PROTECTED_DIR.'admin/add_category.php' : header('Location: index.php'); break;
		case 'editUser' : isUserLoggedIn() ? require_once PROTECTED_DIR.'user/editUser.php' : header('Location: index.php'); break;
		case 'listUser': isUserLoggedIn() && $_SESSION['permission'] > 0 ? require_once PROTECTED_DIR.'admin/listUser.php' : header('Location: index.php'); break;
		case 'modifyUserAdmin' : isUserLoggedIn() && $_SESSION['permission'] > 0 ? require_once PROTECTED_DIR.'admin/modifyUserFromAdmin.php' : header('Location: index.php'); break;
		case 'profile': isUserLoggedIn() ? require_once PROTECTED_DIR.'user/myprofile.php' : header('Location: index.php'); break;
		default: require_once PROTECTED_DIR.'404.php'; break;
	}


?>