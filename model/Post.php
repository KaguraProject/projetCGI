<?php

$this->loadModel('MyPdo');

class Post{
	private $id;
	private $titre;
	private $dateCreation;
	private $dateEdition;
	private $contenu;
	private $important;
	private $id_user;

	public function __construct($id = null){
        if (isset($id)) {
            $myPDO = new MyPDO();
            $sql = "SELECT * FROM posts WHERE id = ?";
            $mPdoSql = $myPDO->prepare($sql);
            $mPdoSql->bindParam(1, $id);
            $mPdoSql->execute();

            $result = $mPdoSql->fetch(PDO::FETCH_OBJ);

            $this->id = $result->id;
            $this->titre = $result->titre;
            $this->dateCreation = $result->dateCreation;
            $this->contenu = $result->contenu;
            $this->id_user = $result->id_user;
            
            
        }
    }

	public function create(){

		$bd = new MyPDO();
		$query = "INSERT INTO posts (titre, dateCreation, contenu, important, id_user) 
			VALUES (:titre,:dateCreation,:contenu,:important, :id_user)";
	   

	    /* Exécute la requête */
	    try{
	    	$req = $bd->prepare($query);

	    	$req->execute(array(
		      ':titre' => $this->titre,
		      ':dateCreation' => $this->dateCreation, 
		      ':contenu'=> $this->contenu, 
		      ':important' => $this->important,
		      ':id_user' => $this->id_user,
		    ));
	    }
	    catch (Exception $e){
	    	die($e->getMessage());
	    }

	}

    public static function getAll(){
        $myPDO = new MyPDO();
        $sql = "SELECT id, id_user, titre, dateCreation, important, LEFT(contenu, 20) as contenu FROM posts";
        $mPdoSql = $myPDO->query($sql);
        return $mPdoSql->fetchAll(PDO::FETCH_OBJ);
    }




    public function getId()
    {
        return $this->id;
    }


    public function getTitre()
    {
        return $this->titre;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;

        
    }

    public function getdateCreation()
    {
        return $this->dateCreation;
    }

    public function setdateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        
    }

    public function getdateEdition()
    {
        return $this->dateEdition;
    }

    public function setdateEdition($dateEdition)
    {
        $this->dateEdition = $dateEdition;
   
    }

    public function getContenu()
    {
        return $this->contenu;
    }

    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

    }

    public function getImportant(){return $this->important;}
    public function setImportant($important){$this->important = $important;}

    public function getIdUser()
    {
        return $this->id_user;
    }

    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }
}