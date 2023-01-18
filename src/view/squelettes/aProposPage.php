<h1> A propos</h1>
<h2> Informations générales</h2>
<p> Ce site a été créé dans le cadre du cours de programmation web de l'Université de Caen </p>

<h2> Auteur </h2>
<p> Ce site a été créé par Romain Andres </a> </p>
<p> Numéro étudiant: <strong> 21904263 </strong> </p>

<h2> Thème de mon site </h2>
<p> Mon site est un site de gestion de runs des jeux Dark Souls&trade; , pour plus d'infos, allez sur <a href="<?php echo $this->router->getHomePageUrl(); ?>">la page d'accueil </a>  </p>

<h2> Le travail réalisé </h2>
<ol>
    <li> Site conforme <a href="https://validator.w3.org/">W3C</a> </li>
    <li> Une page affichant la liste de toutes mes <i>runs</i> </li>
    <li> Une page affichant les détails d'une <i>run</i> </li>
    <li> Une page permettant de créer une <i>run</i> et une page permettant de modifier une <i>run</i></li>
    <li> Un gestion des erreurs avec une protection contre les menaces (Voir mon IsValid de mon Builder)</li>
    <li> Une sauvegarde de mes choix précédents si jamais j'envoie un formule invalide</li>
    <li> Une page permettant de modifier une <i>run</i> </li>
    <li> Une page permettant de supprimer une <i>run</i> </li>
    <li> Un Builder pour manipuler mes <i>runs</i> </li>
    <li> Utilisation d'une base de données MySQL avec protection aux injections sql grâce à l'utilisation de requêtes préparées </li>
    <li> Utilisation d'une classe de stockage pour manipuler les données de la base de données </li>
    <li> Architecture MVCR</li>
    <li> Gestion du feedback & session pour que le site soit aggréable à utiliser </li>
    <li> Gestion des erreurs</li>
    <li> Gestion des erreurs 404 </li>
    <li> Gestion des erreurs de formulaire, par exemple si on créer une Run incorrecte, l'utilisateur est renvoyé sur la page de création de la run et il est indiqué où sont les erreurs qu'il a commis si il y en a</li>
    <li> Redirection en GET </li>
    <li> (Complément) Routage via le chemin virtuel (PATH_INFO) dans les URL plutôt qu'avec des paramètres</li>
</ol>

<h2> Choix techniques </h2>
<p> Ce qui m'a le plus fait réfléchir est l'architecture de la vue, en effet je n'avais jamais fait de site avec une architecture "MVCR" et je me suis demandé comment je pouvais faire pour que ma vue puisse afficher les pages de mon site. J'ai déduit que faire un seul squelette adaptatif était plutôt une mauvaise idée et j'ai donc choisi d'avoir un dossier squelettes avec différents bouts de pages et de laisser ma vue choisir la page adéquat grâce aux sous-squelettes en fonction du controler. Cette architecture permet d'avoir par exemple toujours le même header et le même footer pour chacune de mes pages, sans faire de la redondance de code.</p>

<h2> Les difficultés rencontrées </h2>
<p> Je n'ai pas réussi à faire ce que je voulais précisément pour le path info pour l'url. Je voulais faire un peu comme sur <a href="https://www.youtube.com/channel/UCvnR3rqm6nwvW2c0pp2ws1Q">Youtube</a>, et ne pas afficher le ".php" un peu moche. J'ai réussi à obtenir un URL comme je voulais grâce à une redirection mais après impossible d'agir. Je trouve de manière générale un peu dur la gestion des redirections.</p>

<h2> Mon ressenti </h2>
<p> J'aurais aimé aller plus loin et faire en sorte qu'on ne puisse pas par exemple supprimer n'importe quelle <i>run</i> en passant simplement la bonne url, c'est pas dutout sécurisé et n'importe quel utilisateur peut faire ce qu'il veut. Si j'aurais eu plus de temps, j'aurais créer une page de connexion, d'inscription et de profil et aurait essayer d'éviter que n'importe qui puisse supprimer n'importe quelle run et d'instaurer une limite de Runs par profil/ip </p>

<h2> J'ai veillé à utiliser git durant tout mon projet (mais pas celui fourni, je possède mon propre git personnel d'où le peu de commits"</h2>