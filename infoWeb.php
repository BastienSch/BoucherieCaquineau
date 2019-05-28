<?php 
/**
 * PHP Version 7
 * Verif Class Doc Comment
 *
 * @category Class
 * @package  Package
 * @author   SCHRODER Bastien <bastien.schroder@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 */
session_start();
session_regenerate_id();

if (empty($_SESSION['username'])) {

    header('Location: login.php');
    exit();

}
/**
 * Require the error log
 */
require "errorLog.php";

/**
 * InfoWeb Class Doc Comment
 *
 * @category Class
 * @package  Package
 * @author   SCHRODER Bastien <bastien.schroder@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 */
Class InfoWeb
{
    private $_db;
    private static $_db_dir = '/srv/http/gestionDB.sqlite';

    /**
     * Construct
     *
     * @return object
     */
    public function __construct()
    {
        $db = self::_dbConnect(self::$_db_dir); 
        $this->_setDb($db);
     
    }

    /**
     * Db setter
     *
     * @param object $db DAO
     *
     * @return object
     */
    private function _setDb(PDO $db)
    {
        $this->_db = $db;
    }
    /**
     * Connection to the database 
     *
     * @param string $db_dir Database directory
     *
     * @return object
     */
    private function _dbConnect($db_dir)
    {
        try{
            $db = new PDO('sqlite:'.$db_dir);
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(Exception $e) {
            echo "Impossible d'accéder à la base de données: ".$e->getMessage();
            die();
        }
        return $db;
    }


    /**
     * Add morceau
     **/
    public function addMorceau($value)
    {
        
        self::_addMorceau($value);
         
    }
    /**
     * Add morceau
     */
    private function _addMorceau($value)
    {
        $req = $this->_db->prepare(
            "INSERT INTO typeMorceau (libelle)
            VALUES(:libelle)"
        );
        $req->execute(
            array(
                'libelle' => $value['libelle']
            )
        );      
        
    }

    /**
     * Add animal
     **/
    public function addAnimal($value)
    {
        
        self::_addAnimal($value);
         
    }
    /**
     * Add animal
     */
    private function _addAnimal($value)
    {
        $req = $this->_db->prepare(
            "INSERT INTO animal (libelle)
            VALUES(:libelle)"
        );
        $req->execute(
            array(
                'libelle' => $value['libelle']
            )
        );      
        
    }

    /**
     * Add viande
     **/
    public function addViande($value)
    {
        
        self::_addViande($value);
         
    }
    /**
     * Add viande
     */
    private function _addViande($value)
    {
        $req = $this->_db->prepare(
            "INSERT INTO viande (idMorceau, idAnimal)
            VALUES(:idMorceau, :idAnimal)"
        );
        $req->execute(
            array(
                'idMorceau' => $value['idMorceau'],
                'idAnimal' => $value['idAnimal']
            )
        );      
        
    }

    /**
     * Add Fournisseur
     **/
    public function addFournisseur($value)
    {
        
        self::_addFournisseur($value);
         
    }
    /**
     * Add Fournisseur
     */
    private function _addFournisseur($value)
    {
        $req = $this->_db->prepare(
            "INSERT INTO fournisseur (nomEntreprise, rue, ville, tel, mail, CP, idSecteur)
            VALUES(:nomEntreprise, :rue, :ville, :tel, :mail, :CP, :idSecteur)"
        );
        $req->execute(
            array(
                'nomEntreprise' => $value['nomEntreprise'],
                'rue' => $value['rue'],
                'ville' => $value['ville'],
                'tel' => $value['tel'],
                'mail' => $value['mail'],
                'CP' => $value['CP'],
                'idSecteur' => $value['idSecteur']
            )
        );      
        
    }

    /**
     * Alter Fournisseur
     **/
    public function alterFournisseur($value)
    {
        
        self::_alterFournisseur($value);
         
    }
    /**
     * Alter Fournisseur
     */
    private function _alterFournisseur($value)
    {
        $req = $this->_db->prepare(
            "UPDATE fournisseur SET 
                nomEntreprise = :nomEntreprise,
                rue = :rue,
                ville = :ville,
                tel = :tel,
                mail = :mail,
                CP = :CP,
                idSecteur = :idSecteur
                WHERE idFournisseur=:idFournisseur"
        );

        $req->execute(
            array(
            'nomEntreprise' => $value['nomEntreprise'],
            'rue' => $value['rue'],
            'ville' => $value['ville'],
            'tel' => $value['tel'],
            'mail' => $value['mail'],
            'CP' => $value['CP'],
            'idSecteur' => $value['idSecteur'],
            'idFournisseur' => $value['idFournisseur'])
        );
        
        
    }
    /**
     * Add commande
     **/
    public function addCommande($value)
    {
        
        self::_addCommande($value);
         
    }
    /**
     * Add commande
     */
    private function _addCommande($value)
    {
        $reqCommande = $this->_db->prepare(
            "INSERT INTO commande (montant, date, idFournisseur)
            VALUES(:montant, :date, :idFournisseur)"
        );
        $reqCommande->execute(
            array(
                'montant' => $value['montant'],
                'date' => $value['date'],
                'idFournisseur' => $value['fournisseur']
            )
        );   

        $req = $this->_db->prepare(
            'SELECT idCommande AS id
            FROM Commande 
            WHERE montant = :montant
            AND date = :date
            AND idFournisseur = :idFournisseur
            '
        );
        $req->execute(
            array(
                'montant' => $value['montant'],
                'date' => $value['date'],
                'idFournisseur' => $value['fournisseur']
            )
        );
        $data = $req->fetch(PDO::FETCH_ASSOC);

        $reqAppartenir = $this->_db->prepare(
            "INSERT INTO appartenir (idCommande, idViande, quantite)
            VALUES(:idCommande, :idViande, :quantite)"
        );
        $reqAppartenir->execute(
            array(
                'idCommande' => $data['id'],
                'idViande' => $value['viande'],
                'quantite' => $value['quantite']
            )
        );    
        
    }

    /**
     * Alter Commande
     **/
    public function alterCommande($value)
    {
        
        self::_alterCommande($value);
         
    }
    /**
     * Alter Commande
     */
    private function _alterCommande($value)
    {
        $reqCommande = $this->_db->prepare(
            "UPDATE commande SET 
                montant = :montant,
                date=:date,
                idFournisseur=:idFournisseur
                WHERE idCommande=:idCommande"
        );

        $reqCommande->execute(
            array(
                'montant' => $value['montant'],
                'date' => $value['date'],
                'idFournisseur' => $value['nomEntreprise'],
                'idCommande' => $value['idCommande']
            )
        );  

        $reqAppartenir = $this->_db->prepare(
            "UPDATE appartenir SET 
                quantite = :quantite,
                idViande=:idViande
                WHERE idCommande=:idCommande"
        );

        $reqAppartenir->execute(
            array(
            'quantite' => $value['quantite'],
            'idCommande' => $value['idCommande'],
            'idViande' => $value['viande'])
        );
        
    }

    /**
     * Delete morceau
     **/
    public function deleteMorceau($value)
    {
      
        self::_deleteMorceau($value);
         
    }

    /**
     * Delete morceau
     */
    private function _deleteMorceau($value)
    {

        $req2 = $this->_db->prepare(
            'DELETE FROM typeMorceau
            WHERE idMorceau = :id
            AND libelle = :libelle'
        );
        $req2->execute(
            array(
                'id' => $value['idMorceau'],
                'libelle' => $value['libelle']
            )
        );
       
        
    }

    /**
     * Delete fournisseur
     **/
    public function deleteFournisseur($value)
    {
        
        self::_deleteFournisseur($value);
         
    }

    /**
     * Delete fournisseur
     */
    private function _deleteFournisseur($value)
    {

        $req2 = $this->_db->prepare(
            'DELETE FROM fournisseur
            WHERE idFournisseur = :id
            AND nomEntreprise = :nomEntreprise'
        );
        $req2->execute(
            array(
                'id' => $value['idFournisseur'],
                'nomEntreprise' => $value['nomEntreprise']
            )
        );
       
        
    }

    /**
     * Delete animal
     **/
    public function deleteAnimal($value)
    {
        
        self::_deleteAnimal($value);
         
    }

    /**
     * Delete animal
     */
    private function _deleteAnimal($value)
    {

        $req2 = $this->_db->prepare(
            'DELETE FROM animal
            WHERE idAnimal = :id
            AND libelle = :libelle'
        );
        $req2->execute(
            array(
                'id' => $value['idAnimal'],
                'libelle' => $value['libelle']
            )
        );
       
        
    }
    /**
     * Delete viande
     **/
    public function deleteViande($value)
    {
        
        self::_deleteViande($value);
         
    }

    /**
     * Delete viande
     */
    private function _deleteViande($value)
    {

        $req2 = $this->_db->prepare(
            'DELETE FROM viande
            WHERE idViande = :id'
        );
        $req2->execute(
            array(
                'id' => $value['idViande']
            )
        );
       
        
    }

    /**
     * Delete commande
     **/
    public function deleteCommande($value)
    {
        
        self::_deleteCommande($value);
         
    }

    /**
     * Delete commande
     */
    private function _deleteCommande($value)
    {

        $reqAppartenir = $this->_db->prepare(
            'DELETE FROM appartenir
            WHERE idCommande = :id'
        );
        $reqAppartenir->execute(
            array(
                'id' => $value['idCommande'],
            )
        );

       $reqCommande = $this->_db->prepare(
            'DELETE FROM commande
            WHERE idCommande = :id
            '
        );
        $reqCommande->execute(
            array(
                'id' => $value['idCommande']
            )
        );
        
    }

    /**
     * Select fournisseur
     */
    private function _selectFournisseur()
    {

        $req = $this->_db->prepare(
            'SELECT idFournisseur, nomEntreprise, rue, ville.libelle AS ville, tel, mail, departement.libelle AS CP, secteurActivite.libelle AS libelle 
			FROM fournisseur
			INNER JOIN secteurActivite
			ON fournisseur.idSecteur = secteurActivite.idSecteur
            INNER JOIN ville
            ON fournisseur.idVille=ville.idVille
            INNER JOIN departement
            ON fournisseur.CP= departement.CP'
        );
        $req->execute();
        $data = $req->fetchAll();

        return $data;
    }

    /**
     * Select Departement
     */
    private function _selectDepartement()
    {

        $req = $this->_db->prepare(
            'SELECT CP, libelle 
            FROM departement'
        );
        $req->execute();
        $data = $req->fetchAll();

        return $data;
    }


    /**
     * Select secteur
     */
    private function _selectSecteur()
    {

        $req = $this->_db->prepare(
            'SELECT idSecteur, libelle 
            FROM secteurActivite'
        );
        $req->execute();
        $data = $req->fetchAll();

        return $data;
    }


    /**
     * Select ville
     */
    private function _selectVille()
    {

        $req = $this->_db->prepare(
            'SELECT idVille, libelle 
            FROM ville'
        );
        $req->execute();
        $data = $req->fetchAll();

        return $data;
    }

    /**
     * Select all viandes 
     */
    private function _selectAllViande()
    {

        $req = $this->_db->prepare(
            'SELECT viande.idViande, typeMorceau.libelle AS libelleMorceau, animal.libelle AS libelleAnimal
            FROM animal 
            INNER JOIN viande
            ON animal.idAnimal = viande.idAnimal
            INNER JOIN typeMorceau 
            ON viande.idMorceau = typeMorceau.idMorceau
            '
        );
        $req->execute();
        $data = $req->fetchAll();
        return $data;
    }

    /**
     * Select viande
     */
    private function _selectViande($idViande)
    {

        $req = $this->_db->prepare(
            'SELECT viande.idViande, typeMorceau.libelle AS libelleMorceau, animal.libelle AS libelleAnimal
            FROM animal 
            INNER JOIN viande
            ON animal.idAnimal = viande.idAnimal
            INNER JOIN typeMorceau 
            ON viande.idMorceau = typeMorceau.idMorceau
            WHERE viande.idViande = :idViande
            '
        );
        $req->execute(
            array(
                'idViande' => $idViande
            )
        );
        $data = $req->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    /**
     * Select commande
     */
    private function _selectCommande()
    {

        $req = $this->_db->prepare(
            'SELECT fournisseur.nomEntreprise AS nomEntreprise, commande.idCommande as idCommande,  commande.montant AS montant, commande.date AS dateC, appartenir.quantite AS quantite, appartenir.idViande as idViande
            FROM fournisseur 
            INNER JOIN commande
            ON fournisseur.idFournisseur = commande.idFournisseur
            INNER JOIN appartenir 
            ON commande.idCommande = appartenir.idCommande'
        );
        $req->execute();
        $data = $req->fetchAll();
        
        return $data;
    }

    /**
     * Select morceau
     */
    private function _selectMorceau()
    {

        $req = $this->_db->prepare(
            'SELECT idMorceau, libelle 
            FROM typeMorceau'
        );
        $req->execute();
        $data = $req->fetchAll();
        return $data;
    }

    /**
     * Select animaux
     *
     * @return array
     */
    private function _selectAnimaux()
    {

        $req = $this->_db->prepare(
            'SELECT idAnimal, libelle 
            FROM animal'
        );
        $req->execute();
        $data = $req->fetchAll();
        return $data;
    }

    /**
     * Liste des fournisseurs
     **/
    public function fournisseurList()
    {
        
        $data = self::_selectFournisseur();
 
       
        foreach ($data as $key => $ligne) {

            echo "<tr>";
            echo "<td>".$ligne['idFournisseur']."</td>";
            echo "<td>".$ligne['nomEntreprise']."</td>";
            echo "<td>".$ligne['libelle']."</td>";
            echo "<td>".$ligne['rue']." ".$ligne['ville']." ".$ligne['CP']."</td>";
            echo "<td>".$ligne['tel']."</td>";
            echo "<td>".$ligne['mail']."</td>";
            echo "<td><a href=\"alterFournisseur.php?idFournisseur=".$ligne['idFournisseur']."&nomEntreprise=".$ligne['nomEntreprise']."&libelle=".$ligne['libelle']."&rue=".$ligne['rue']."&ville=".$ligne['ville']."&CP=".$ligne['CP']."&tel=".$ligne['tel']."&mail=".$ligne['mail']."\" class=\"button-alter button\">Modifier </a></td>";
                
            $del = self::_fournisseurCheck($ligne['idFournisseur']);
            if ($del===true){
                echo "<td>
                                <button onclick=\"document.getElementById('".$ligne['idFournisseur']."').style.display='block'\" >Supprimer</button>
                                <div id=\"".$ligne['idFournisseur']."\" class=\"modal\">
                                    <div class=\"modal-content\">
                                        <div class=\"modal-container\">
                                            <span onclick=\"document.getElementById('".$ligne['idFournisseur']."').style.display='none'\" class=\"display-topright\">&times;</span>
                                            <h4>Supprimer ?</h4>
                                            <a href=\"infoWeb.php?delFournisseur&idFournisseur=".$ligne['idFournisseur']."&nomEntreprise=".$ligne['nomEntreprise']."\">Valider</a>
                                        </div>
                                    </div>
                                </div>
                            </td>";
            } else {echo "<td></td>";}                
            echo "</tr>";
        }
    }

    /**
     * Liste des commandes
     **/
    public function commandeList()
    {
        
        $data = self::_selectCommande();
 
      
        foreach ($data as $key => $ligne) {
            $viande = self::_selectViande($ligne['idViande']);
            echo "<tr>";
            echo "<td>".$ligne['idCommande']."</td>";
            echo "<td>".$ligne['nomEntreprise']."</td>";
            echo "<td>".$ligne['montant']."</td>";
            echo "<td>".$ligne['dateC']."</td>";
            echo "<td>".$viande['libelleAnimal']."</td>";
            echo "<td>".$viande['libelleMorceau']."</td>";
            echo "<td>".$ligne['quantite']."</td>";
             echo "<td><a href=\"alterCommande.php?idCommande=".$ligne['idCommande']."&nomEntreprise=".$ligne['nomEntreprise']."&montant=".$ligne['montant']."&dateC=".$ligne['dateC']."&libelleAnimal=".$viande['libelleAnimal']."&libelleMorceau=".$viande['libelleMorceau']."&quantite=".$ligne['quantite']."&idViande=".$ligne['idViande']."\" class=\"button-alter button\">Modifier </a></td>";
                
            echo "<td>
                            <button onclick=\"document.getElementById('".$ligne['idCommande']."').style.display='block'\" >Supprimer</button>
                            <div id=\"".$ligne['idCommande']."\" class=\"modal\">
                                <div class=\"modal-content\">
                                    <div class=\"modal-container\">
                                        <span onclick=\"document.getElementById('".$ligne['idCommande']."').style.display='none'\" class=\"display-topright\">&times;</span>
                                        <h4>Supprimer ?</h4>
                                        <a href=\"infoWeb.php?delCommande&idCommande=".$ligne['idCommande']."&nomEntreprise=".$ligne['nomEntreprise']."\">Valider</a>
                                    </div>
                                </div>
                            </div>
                        </td>";
            echo "</tr>";
        }
    }
    /**
     * Liste des viandes
     **/
    public function viandeList()
    {
        
        $data = self::_selectAllViande();
        
       
        foreach ($data as $key => $ligne) {
            
            echo "<tr>";
            echo "<td>".$ligne['idViande']."</td>";
            echo "<td>".$ligne['libelleAnimal']."</td>";
            echo "<td>".$ligne['libelleMorceau']."</td>";
            $del = self::_viandeCheck($ligne['idViande']);
            if ($del===true){
                echo "<td>
                                <button onclick=\"document.getElementById('".$ligne['idViande']."').style.display='block'\" >Supprimer</button>
                                <div id=\"".$ligne['idViande']."\" class=\"modal\">
                                    <div class=\"modal-content\">
                                        <div class=\"modal-container\">
                                            <span onclick=\"document.getElementById('".$ligne['idViande']."').style.display='none'\" class=\"display-topright\">&times;</span>
                                            <h4>Supprimer ?</h4>
                                            <a href=\"infoWeb.php?delViande&idViande=".$ligne['idViande']."\">Valider</a>
                                        </div>
                                    </div>
                                </div>
                            </td>";
            } else {echo "<td></td>";}      
            echo "</tr>";
        }
    }

    /**
     * Liste des animaux
     **/
    public function animauxList()
    {
        
        $data = self::_selectAnimaux();
        
       
        foreach ($data as $key => $ligne) {
            
            echo "<tr>";
            echo "<td>".$ligne['idAnimal']."</td>";
            echo "<td>".$ligne['libelle']."</td>";
            $del = self::_animalCheck($ligne['idAnimal']);
            if ($del===true){
                echo "<td>
                                <button onclick=\"document.getElementById('".$ligne['idAnimal']."').style.display='block'\" >Supprimer</button>
                                <div id=\"".$ligne['idAnimal']."\" class=\"modal\">
                                    <div class=\"modal-content\">
                                        <div class=\"modal-container\">
                                            <span onclick=\"document.getElementById('".$ligne['idAnimal']."').style.display='none'\" class=\"display-topright\">&times;</span>
                                            <h4>Supprimer ?</h4>
                                            <a href=\"infoWeb.php?delAnimal&idAnimal=".$ligne['idAnimal']."&libelle=".$ligne['libelle']."\">Valider</a>
                                        </div>
                                    </div>
                                </div>
                            </td>";
            } else {echo "<td></td>";}

            echo "</tr>";
        }
    }

    /**
     * Liste des villes
     **/
    public function villeList()
    {
        
        $data = self::_selectVille();
        
       
        foreach ($data as $key => $ligne) {
            
            echo "<tr>";
            echo "<td>".$ligne['idVille']."</td>";
            echo "<td>".$ligne['libelle']."</td>";

            echo "</tr>";
        }
    }

    /**
     * Select departement
     **/
    public function departementSelect()
    {
        
        $data = self::_selectDepartement();
        
       
        foreach ($data as $key => $ligne) {
            
               echo "<option value='".$ligne['CP']."'>".$ligne['libelle']."</option>"; 
   
        }
    }

    /**
     * Select departement
     **/
    public function villeSelect()
    {
        
        $data = self::_selectVille();
        
       
        foreach ($data as $key => $ligne) {
            
               echo "<option value='".$ligne['idVille']."'>".$ligne['libelle']."</option>"; 
   
        }
    }


    /**
     * Select departement
     **/
    public function departementSelected($get)
    {
        
        $data = self::_selectDepartement();
        
       
        foreach ($data as $key => $ligne) {
            if($ligne['libelle']===$get){
                    echo "<option selected=\"selected\" value='".$ligne['CP']."'>".$ligne['libelle']."</option>"; 
            } else {
                echo "<option value='".$ligne['CP']."'>".$ligne['libelle']."</option>"; 
            }
            
           
   
        }
    }

    /**
     * Select secteur
     **/
    public function secteurSelected($get)
    {
        
        $data = self::_selectSecteur();
        
       
        foreach ($data as $key => $ligne) {
            if($ligne['libelle']===$get){
                    echo "<option selected=\"selected\" value='".$ligne['idSecteur']."'>".$ligne['libelle']."</option>"; 
            } else {   
                echo "<option value='".$ligne['idSecteur']."'>".$ligne['libelle']."</option>";
            }
        }
    }

    /**
     * Select secteur
     **/
    public function secteurSelect()
    {
        
        $data = self::_selectSecteur();
        
       
        foreach ($data as $key => $ligne) {

                echo "<option value='".$ligne['idSecteur']."'>".$ligne['libelle']."</option>";
            
        }
    }

    /**
     * Select animal
     **/
    public function animalSelect()
    {
        
        $data = self::_selectAnimaux();
        
       
        foreach ($data as $key => $ligne) {
            
            echo "<option value='".$ligne['idAnimal']."'>".$ligne['libelle']."</option>";
            
        }
    }


    /**
     * Select morceau
     **/
    public function morceauSelect()
    {
        
        $data = self::_selectMorceau();
        
       
        foreach ($data as $key => $ligne) {
            
            echo "<option value='".$ligne['idMorceau']."'>".$ligne['libelle']."</option>";
            
        }
    }

    /**
     * Select fournisseur
     **/
    public function fournisseurSelect()
    {
        
        $data = self::_selectFournisseur();
        
       
        foreach ($data as $key => $ligne) {
            
            echo "<option value='".$ligne['idFournisseur']."'>".$ligne['nomEntreprise']."</option>";
            
        }
    }

    /**
     * Selected fournisseur
     **/
    public function fournisseurSelected($get)
    {
        
        $data = self::_selectFournisseur();
        
       
        foreach ($data as $key => $ligne) {
            if($ligne['nomEntreprise']===$get){
                    echo "<option selected=\"selected\" value='".$ligne['idFournisseur']."'>".$ligne['nomEntreprise']."</option>"; 
            } else {   
                echo "<option value='".$ligne['idFournisseur']."'>".$ligne['nomEntreprise']."</option>";
            }
        }
    }
    /**
     * Select viande
     **/
    public function viandeSelect()
    {
        
        $data = self::_selectAllViande();
        
       
        foreach ($data as $key => $ligne) {
            
            echo "<option value='".$ligne['idViande']."'>".$ligne['libelleAnimal']." ".$ligne['libelleMorceau']."</option>";
            
        }
    }

    /**
     * Selected viande
     **/
    public function viandeSelected($animal,$morceau)
    {
        
        $data = self::_selectAllViande();
        
       
        foreach ($data as $key => $ligne) {
            if($ligne['libelleAnimal']===$animal && $ligne['libelleMorceau']===$morceau){
                    echo "<option selected=\"selected\" value='".$ligne['idViande']."'>".$ligne['libelleAnimal']."".$ligne['libelleMorceau']."</option>"; 
            } else {   
                 echo "<option value='".$ligne['idViande']."'>".$ligne['libelleAnimal']." ".$ligne['libelleMorceau']."</option>";
            }
        }
    }
    /**
     * Check Animal for delete 
     */
    private function _animalCheck($animal)
    {

        $req = $this->_db->prepare(
            'SELECT idViande
            FROM viande 
            WHERE idAnimal = :idAnimal
            '
        );
        $req->execute(
            array(
                'idAnimal' => $animal
            )
        );
        $data = $req->fetch(PDO::FETCH_ASSOC);

        if ($data===false) {
            return true;
        } else {

            return false;
        }
    }
    /**
     * Check Morceau for delete 
     */
    private function _morceauCheck($morceau)
    {

        $req = $this->_db->prepare(
            'SELECT idViande
            FROM viande 
            WHERE idMorceau = :idMorceau
            '
        );
        $req->execute(
            array(
                'idMorceau' => $morceau
            )
        );
        $data = $req->fetch(PDO::FETCH_ASSOC);

        if ($data===false) {
            return true;
        } else {

            return false;
        }
    }

   /**
     * Check Viande for delete  
     */
    private function _viandeCheck($viande)
    {

        $req = $this->_db->prepare(
            'SELECT idCommande
            FROM appartenir 
            WHERE idViande = :idViande
            '
        );
        $req->execute(
            array(
                'idViande' => $viande
            )
        );
        $data = $req->fetch(PDO::FETCH_ASSOC);

        if ($data===false) {
            return true;
        } else {

            return false;
        }
    }

    /**
     * Check fournisseur for delete  
     */
    private function _fournisseurCheck($fournisseur)
    {

        $req = $this->_db->prepare(
            'SELECT idCommande
            FROM commande 
            WHERE idFournisseur = :idFournisseur
            '
        );
        $req->execute(
            array(
                'idFournisseur' => $fournisseur
            )
        );
        $data = $req->fetch(PDO::FETCH_ASSOC);

        if ($data===false) {
            return true;
        } else {

            return false;
        }
    }

    /**
     * morceau List
     **/
    public function morceauList()
    {
        
        $data = self::_selectMorceau();

        
        foreach ($data as $key => $ligne) {

            echo "<tr>";
            echo "<td>".$ligne['idMorceau']."</td>";
            echo "<td>".$ligne['libelle']."</td>";
            $del = self::_morceauCheck($ligne['idMorceau']);
            if ($del===true){
                echo "<td>
                            <button onclick=\"document.getElementById('".$ligne['idMorceau']."').style.display='block'\" >Supprimer</button>
                            <div id=\"".$ligne['idMorceau']."\" class=\"modal\">
                                <div class=\"modal-content\">
                                    <div class=\"modal-container\">
                                        <span onclick=\"document.getElementById('".$ligne['idMorceau']."').style.display='none'\" class=\"display-topright\">&times;</span>
                                        <h4>Ajouter aux pairs ?</h4>
                                        <a href=\"infoWeb.php?delMorceau&idMorceau=".$ligne['idMorceau']."&libelle=".$ligne['libelle']."\">Valider</a>
                                    </div>
                                </div>
                            </div>
                        </td>";

            } else {echo "<td></td>";}
            
            echo "</tr>";
        }
    }


}


switch(true)
{
case isset($_GET['delMorceau']):


        $infoWeb = new InfoWeb();
        echo $infoWeb->deleteMorceau($_GET);
        header('Location: listMorceau.php');
    

    break;
case isset($_GET['delFournisseur']):


        $infoWeb = new InfoWeb();
        echo $infoWeb->deleteFournisseur($_GET);
        header('Location: index.php');
    

    break;
case isset($_GET['delCommande']):


        $infoWeb = new InfoWeb();
        echo $infoWeb->deleteCommande($_GET);
        header('Location: listCommande.php');
    

    break;
case isset($_GET['delViande']):


        $infoWeb = new InfoWeb();
        echo $infoWeb->deleteViande($_GET);
        header('Location: listViande.php');
    

    break;
case isset($_GET['delAnimal']):


        $infoWeb = new InfoWeb();
        echo $infoWeb->deleteAnimal($_GET);
        header('Location: listAnimaux.php');
    

    break;
case isset($_GET['addMorceau']):


        $infoWeb = new InfoWeb();
        echo $infoWeb->addMorceau($_GET);
        header('Location: listMorceau.php');
    

    break;
case isset($_GET['addFournisseur']):


        $infoWeb = new InfoWeb();
        echo $infoWeb->addFournisseur($_GET);
        header('Location: index.php');
    

    break;
case isset($_GET['addViande']):


        $infoWeb = new InfoWeb();
        echo $infoWeb->addViande($_GET);
        header('Location: listViande.php');
    

    break;
case isset($_GET['addAnimal']):


        $infoWeb = new InfoWeb();
        echo $infoWeb->addAnimal($_GET);
        header('Location: listAnimaux.php');
    

    break;
case isset($_GET['addCommande']):


        $infoWeb = new InfoWeb();
        echo $infoWeb->addCommande($_GET);
        header('Location: listCommande.php');
    

    break;
case isset($_GET['alterFournisseur']):


        $infoWeb = new InfoWeb();
        echo $infoWeb->alterFournisseur($_GET);
        header('Location: index.php');
    

    break;
case isset($_GET['alterCommande']):


        $infoWeb = new InfoWeb();
        echo $infoWeb->alterCommande($_GET);
        header('Location: listCommande.php');
    

    break;
}