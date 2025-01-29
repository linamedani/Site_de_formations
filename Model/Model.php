<?php

class Model
{
    /**
     * Attribut contenant l'instance PDO
     */
    private $bd;

    /**
     * Attribut statique qui contiendra l'unique instance de Model
     */
    private static $instance = null;

    /**
     * Constructeur : effectue la connexion à la base de données.
     */
    private function __construct()
    {
        include "Utils/credentials.php";

        $this->bd = new PDO($dsn, $login, $mdp);
        $this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->bd->query("SET nameS 'utf8'");
    }

    /**
     * Méthode permettant de récupérer un modèle car le constructeur est privé (Implémentation du Design Pattern Singleton)
     */
    public static function getModel()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Retourne la liste des formateurs
     */
    public function getList()
    {
        $req = $this->bd->prepare('SELECT * FROM formateur ');
        $req->execute();
        return $req->fetchall();
    }

    /**
     * Retourne le nombre de prix de catégorie
     * @return [int]
     */
    public function getNbCategorie()
    {
        $req = $this->bd->prepare('SELECT COUNT(*) FROM categorie');
        $req->execute();
        $tab = $req->fetch(PDO::FETCH_NUM);
        return $tab[0];
    }

    
    /**
     * Retourne un tableau contenant les informations de categorie (ou false s'il n'existe pas)
     * @param [int] $id identifian de Categorie
     * @return [array ou false] Tableau contenant les infos( id_categorie,nomCategorie,nom_categorie_compsé) ou false
     */
    
    public function getCategorieInformations($limit=-1)
    {
        $sql = 'SELECT c.id_categorie AS categorie_id, c.nomCategorie AS categorie_nom,
        comp.nomCategorie AS categorie_compsé_nom FROM categorie c LEFT JOIN
        categorie comp ON c.id_categorie_compsé = comp.id_categorie order by c.id_categorie ASC '.($limit > 0 ? ' LIMIT :limit' : '');

        $requete = $this->bd->prepare($sql);
        if ($limit > 0){
            $requete->bindValue(':limit', $limit);
        }

        $requete->execute();

        $rows = array();

        while ($row = $requete->fetch(PDO::FETCH_ASSOC)){
            $rows[] = $row;
        }

        return $rows;
    }

     /**
     * Retourne un tableau contenant les informations du categorie (ou false s'il n'existe pas)
     * @param [int] $id identifian du prix Nobel
     * @return [array ou false] Tableau contenant les infos(id, year, name, category, birthdate, birthplace, county, motivation) ou false
     */
    public function getCategorieInformations2 ($id)
    {
        $requete = $this->bd->prepare('Select * from categorie WHERE id = :id');
        $requete->bindValue(':id', $id);
        $requete->execute();
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Retourne true si la table categorie contient une categorie d'identifiant $id, false sinon
     * @param int $id identifiant de categorie
     * @return boolean
     */
    public function categorieIsInDataBase($id)
    {
        return $this->getCategorieInformations2($id) !== false;
    }

    /**
     * Retourne les themes 
     * @return [array] Tableau contenant les themes (les valeurs sont les thémes, les clés les indices)
     */
    public function getThemes()
    {
        $requete = $this->bd->prepare('SELECT nomtheme FROM theme');
        $requete->execute();
        $reponse = [];
        while ($ligne = $requete->fetch(PDO::FETCH_ASSOC)) {
            $reponse[] = $ligne['nomtheme'];
        }
        return $reponse;
    }
    
    public function getIDfromEmail($mail){
        $requete = $this->bd-> prepare('SELECT id_utilisateur FROM utilisateur WHERE mail =:mail');
        $requete->bindValue(':mail', $mail);
        $requete->execute();
        return $requete->fetch(PDO::FETCH_ASSOC);
    }
    public function getMdpfromEmail($mail){
        $requete = $this->bd-> prepare('SELECT password FROM utilisateur WHERE mail =:mail');
        $requete->bindValue(':mail', $mail);
        $requete->execute();
        $r=$requete->fetch(PDO::FETCH_ASSOC);
        return $r;
        
    }
    public function getUtilisateurInformations($mail)
    {
        $requete = $this->bd->prepare('SELECT * FROM utilisateur WHERE mail = :mail');
        $requete->bindValue(':mail', $mail);
        $requete->execute();
        $l=$requete->fetch(PDO::FETCH_ASSOC);
        return $l;
    }
    public function userExist($login){
       return  $this->getUtilisateurInformations($login) !==false;
        
      

    }
    public function clientExist($mail){
        $info=$this->getUtilisateurInformations($mail);
        $idBd=$info['id_utilisateur'];
        $requete=$this->bd->prepare('SELECT * FROM client WHERE  id_utilisateur= :id');
        $requete->bindValue('id', $idBd);
        $requete->execute();
        return (bool) $requete->rowCount();
}
    public function formateurExist($mail){
        $info=$this->getUtilisateurInformations($mail);
        $idBd=$info['id_utilisateur'];
        $requete=$this->bd->prepare('SELECT * FROM formateur  WHERE  id_utilisateur= :id');
        $requete->bindValue('id', $idBd);
        $requete->execute();
        return (bool) $requete->rowCount();

        }
    public function adminExist($mail){
        $info=$this->getUtilisateurInformations($mail);
        $idBd=$info['id_utilisateur'];
        $requete=$this->bd->prepare('SELECT * FROM admin  WHERE  id_utilisateur= :id');
        $requete->bindValue('id', $idBd);
        $requete->execute();
        return (bool) $requete->rowCount();
    }
    public function roleUtilisateur($mail){
        $tab=[];
        if($this->clientExist($mail)){
         $tab[]="client";
        }
        if ($this-> adminExist($mail)){
         $tab[]="admin";
        }
        if ($this-> formateurExist($mail)){
            $tab[]= "formateur";
        }
        return $tab;    }
    
    
    
    public function listeFormateur(){
        $requete = $this->bd->prepare('SELECT id_utilisateur FROM formateur');
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getNomFormateur($id) {
        $requete = $this->bd->prepare('SELECT nom FROM utilisateur WHERE id_utilisateur = :id');
        $requete->bindValue(':id', $id['id_utilisateur']);
        $requete->execute();

        return $requete->fetchColumn();
    }
    public function getPrenomFormateur($id){
        $requete=$this->bd->prepare('SELECT prenom FROM utilisateur  WHERE  id_utilisateur= :id');
        $requete->bindValue(':id', $id['id_utilisateur']);
        $requete->execute();
        return $requete->fetchColumn();
    }
    public function getNomThemeParUtilisateur($id) {
        $requete = $this->bd->prepare('SELECT t.nomTheme 
                                       FROM theme t
                                       JOIN expertiseProfessionnelle e ON t.id_theme = e.id_theme
                                       WHERE e.id_utilisateur = :id');
        $requete->bindValue(':id', $id['id_utilisateur']);
        $requete->execute();

        return $requete->fetchColumn();
    }
    public function getNbTheme()
    {
        $req = $this->bd->prepare('SELECT COUNT(*) FROM theme');
        $req->execute();
        $tab = $req->fetch(PDO::FETCH_NUM);
        return $tab[0]; 
    }
 
     /**
     * Retourne le nombre de catégorie
     * @return [int]
     */
   
    
    public function getNbExpertise()
    {
        $req = $this->bd->prepare('SELECT COUNT(*) FROM expertiseprofessionnelle');
        $req->execute();
        $tab = $req->fetch(PDO::FETCH_NUM);
        return $tab[0]; 
    }

    public function  getNbExperience ()
    {
        $req = $this->bd->prepare('SELECT COUNT(*) FROM experiencepedagogique');
        $req->execute();
        $tab = $req->fetch(PDO::FETCH_NUM);
        return $tab[0]; 
    }

    

   
    

    /**
     * Retourne true si la table categorie contient une categorie d'identifiant $id, false sinon
     * @param int $id identifiant de categorie
     * @return boolean
     */
   /* public function categorieIsInDataBase($id)
    {
        return $this->getCategorieInformations2($id) !== false;
    }
*/
    public function categorieInDataBase($nomCategorie) {
        $requete = $this->bd->prepare('SELECT COUNT(*) FROM categorie WHERE LOWER(nomCategorie) = LOWER(:nomCategorie)');
        $requete->bindParam(':nomCategorie', $nomCategorie, PDO::PARAM_STR);
        $requete->execute();
        $resultat = $requete->fetch(PDO::FETCH_COLUMN);
        return $resultat > 0;
       
    }

    public function themeInDataBase($nomTheme) {
        $requete = $this->bd->prepare('SELECT COUNT(*) FROM theme WHERE LOWER(nomTheme) = LOWER(:nomTheme)');
        $requete->bindParam(':nomTheme', $nomTheme, PDO::PARAM_STR);
        $requete->execute();
        $resultat = $requete->fetch(PDO::FETCH_COLUMN);
        return $resultat > 0;
       
    }

    /**
     * Retourne les themes 
     * @return [array] Tableau contenant les themes (les valeurs sont les thémes, les clés les indices)
     */
    
    

    public function getCategorie(){
        $requete = $this->bd->prepare('SELECT DISTINCT nomCategorie FROM categorie 
         WHERE id_categorie_compsé IS NOT NULL');
        $requete->execute();
        $reponse = [];
        while ($ligne = $requete->fetch(PDO::FETCH_ASSOC)) {
            $reponse[] = $ligne['nomcategorie'];
        }
        return $reponse;
    }

    public function getSousCategorie(){
        $requete = $this->bd->prepare('SELECT DISTINCT nomCategorie As a  FROM categorie 
         WHERE id_categorie_compsé IS NULL');
        $requete->execute();
        $reponse = [];
        while ($ligne = $requete->fetch(PDO::FETCH_ASSOC)) {
            $reponse[] = $ligne['a'];
        }
        return $reponse;
    }

    public function getNiveaux(){
        $requete = $this->bd->prepare('SELECT libelleniveau FROM niveau');
        $requete->execute();
        $reponse = [];
        
        while ($ligne = $requete->fetch(PDO::FETCH_ASSOC)) {
            $reponse[] = $ligne['libelleniveau'];
        }
        
        return $reponse;
    }

    public function getIdCategorie($nomCategorie) {
        $requete = $this->bd->prepare('SELECT id_categorie FROM categorie WHERE nomCategorie = :nomCategorie');
        $nomCategorie = strtolower($nomCategorie);
        $requete->bindParam(':nomCategorie', $nomCategorie, PDO::PARAM_STR);
        $requete->execute();
        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        return $resultat['id_categorie'];
    }

    public function getIdTheme($nomTheme) {
        $requete = $this->bd->prepare('SELECT id_theme FROM theme WHERE  nomTheme = :nomTheme');
        $requete->bindParam(':nomTheme', $nomTheme, PDO::PARAM_STR);
        $requete->execute();
        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        return $resultat['id_theme'];
    }

    public function getIdNiveau($libelleNiveau) {
        $requete = $this->bd->prepare('SELECT id_niveau FROM niveau WHERE libelleNiveau = :libelleNiveau');
        $requete->bindParam(':libelleNiveau', $libelleNiveau, PDO::PARAM_STR);
        $requete->execute();
        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        return $resultat['id_niveau'];
    }

    public function getIdFormateur($mail) {
        $requete = $this->bd->prepare('SELECT id_utilisateur FROM utilisateur WHERE mail = :mail');
        $requete->bindParam(':mail', $mail, PDO::PARAM_STR);
        $requete->execute();
        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        return $resultat['id_utilisateur'];
    }


    
    
    public function ajouterTheme($nomtheme, $id_cate ){

        $theme = $this->getNbTheme() + 1 ; 
        $requete = $this->bd->prepare('INSERT INTO theme (id_theme, nomtheme, validetheme, id_categorie) VALUES (:id_theme, :nomtheme, :validetheme, :id_categorie )');
        $requete->bindParam(':id_theme',  $theme, PDO::PARAM_STR);
        $requete->bindParam(':nomtheme', $nomtheme , PDO::PARAM_INT);
        $requete->bindValue(':validetheme', 'True', PDO::PARAM_STR);
        $requete->bindParam(':id_categorie', $id_cate, PDO::PARAM_STR); 
        $requete->execute();
    }

    public function ajouterSousCategorie($nomCategorie){

        $idCategorie = $this->getNbCategorie() + 1 ;

        // Validez et traitez la variable $nouveauCategorie si nécessaire     
        $requete = $this->bd->prepare('INSERT INTO categorie(id_categorie, nomcategorie, validecategorie, id_categorie_compsé) VALUES (:idCategorie, :nomCategorie, :valideCategorie, :idCategorieCompose)');
        $requete->bindParam(':idCategorie', $idCategorie , PDO::PARAM_INT);
        $requete->bindParam(':nomCategorie', $nomCategorie, PDO::PARAM_STR);
        $requete->bindValue(':valideCategorie', 'True', PDO::PARAM_STR); 
        $requete->bindValue(':idCategorieCompose', Null, PDO::PARAM_NULL); 
        $requete->execute();
    }

    public function ajouterCategorie($nomCategorie, $idCategorie1){

        $idCategorie = $this->getNbCategorie() + 1 ;

        // Validez et traitez la variable $nouveauCategorie si nécessaire     
        $requete = $this->bd->prepare('INSERT INTO categorie(id_categorie, nomcategorie, validecategorie, id_categorie_compsé) VALUES (:idCategorie, :nomCategorie, :valideCategorie, :idCategorieCompose)');
        $requete->bindParam(':idCategorie', $idCategorie , PDO::PARAM_INT);
        $requete->bindParam(':nomCategorie', $nomCategorie, PDO::PARAM_STR);
        $requete->bindValue(':valideCategorie', 'True', PDO::PARAM_STR); 
        $requete->bindParam(':idCategorieCompose', $idCategorie1, PDO::PARAM_STR); 
        

         $requete->execute();
       
        
    }

    public function ajouterExpertise($id_utilisateur, $id_theme, $dureeexperience, $commentaire ){

       

        $requete = $this->bd->prepare('INSERT INTO expertiseProfessionnelle (id_utilisateur, id_theme, dureeexperience, commentaire, id_niveau)
         VALUES (:id_utilisateur, :id_theme, :dureeexperience, :commentaire, :id_niveau)');
        $requete->bindParam(':id_utilisateur', $id_utilisateur , PDO::PARAM_INT);
        $requete->bindParam(':id_theme', $id_theme, PDO::PARAM_INT);
        $requete->bindParam(':dureeexperience', $dureeexperience, PDO::PARAM_INT); 
        $requete->bindParam(':commentaire', $commentaire, PDO::PARAM_STR); 
        $requete->bindParam(':id_niveau', $id_niveau, PDO::PARAM_INT);
        $requete->execute();
    }

    public function ajouterExperience($id_utilisateur, $id_theme, $id_public, $volumehorrairemoyensession, $nbsessioneffectuee, $commentaire){

        

        $requete = $this->bd->prepare('INSERT INTO experiencePedagogique (id_utilisateur, id_theme, id_public, volumehorrairemoyensession, nbsessioneffectuee, commentaire)
         VALUES (:id_utilisateur, :id_theme, :id_public, :volumehorrairemoyensession, :nbsessioneffectuee, :commentaire)');
        $requete->bindParam(':id_utilisateur', $id_utilisateur , PDO::PARAM_INT);
        $requete->bindParam(':id_theme', $id_theme, PDO::PARAM_INT);
        $requete->bindParam(':id_public', $id_public, PDO::PARAM_INT); 
        $requete->bindParam(':volumehorrairemoyensession', $volumehorrairemoyensession, PDO::PARAM_INT); 
        $requete->bindParam(':nbsessioneffectuee', $nbsessioneffectuee, PDO::PARAM_INT);
        $requete->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);
        $requete->execute();
    }
   

    public function emailExists($email) {
        $requete = $this->bd->prepare('SELECT COUNT(*) FROM utilisateur WHERE mail = :mail');
        $requete->bindValue(':mail', $email);
        $requete->execute();
        $count = $requete->fetchColumn();
        return $count > 0;
    }

    

    public function createUser($email, $password, $nom, $prenom) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $_SESSION['password']=$passwordHash;
    
        // Insérer dans la table utilisateur et récupérer l'ID généré automatiquement
        $reqUtilisateur = $this->bd->prepare('INSERT INTO utilisateur (mail, password, nom, prenom) VALUES (:mail, :password, :nom, :prenom) RETURNING id_utilisateur');
        $reqUtilisateur->bindValue(':mail', $email);
        $reqUtilisateur->bindValue(':password', $passwordHash);
        $reqUtilisateur->bindValue(':nom', $nom);
        $reqUtilisateur->bindValue(':prenom', $prenom);
    
        $successUserInsert = $reqUtilisateur->execute();
    
        if ($successUserInsert) {
            // Récupérer l'ID généré automatiquement
            $id_ut = $reqUtilisateur->fetchColumn();
    
            return $id_ut;
        } else {
            return false;
        }
    }
    
    public function insertClientData($email, $password, $nom, $prenom, $societe) {
        $id_ut = $this->createUser($email, $password, $nom, $prenom);
    
        $reqClient = $this->bd->prepare('INSERT INTO client (id_utilisateur, societe) VALUES (:id, :societe)');
        $reqClient->bindValue(':id', $id_ut);
        $reqClient->bindValue(':societe', $societe);
    
        return (bool) $reqClient->execute();
    }
    
    public function insertFormateurData($email, $password, $nom, $prenom, $linkedin) {
        $id_ut = $this->createUser($email, $password, $nom, $prenom);
    
        $reqFormateur = $this->bd->prepare('INSERT INTO formateur (id_utilisateur, linkedin) VALUES (:id, :linkedin)');
        $reqFormateur->bindValue(':id', $id_ut);
        $reqFormateur->bindValue(':linkedin', $linkedin);
    
        return (bool) $reqFormateur->execute();
    }

    public function saveMessage($formateur, $name, $email, $phone, $message){
        $sql = "INSERT INTO message(texte, dateheure, validem, lu, id_utilisateur, id_utilisateur_1, id_discussion)".
            "VALUES (:texte, :dateheure, :validem, :lu, :id_utilisateur, :id_utilisateur_1, :id_discussion);";

        $requete = $this->bd->prepare($sql);

        $dateheure = date("Y-m-d H:i:s", time());
        
        $requete->bindValue(':texte', $message);
        $requete->bindValue(':dateheure', $dateheure);
        $requete->bindValue(':validem', null);
        $requete->bindValue(':lu', null);
        $requete->bindValue(':id_utilisateur', 2);
        $requete->bindValue(':id_utilisateur_1', 1);
        $requete->bindValue(':id_discussion', null);

        $requete->execute();
    }
}
