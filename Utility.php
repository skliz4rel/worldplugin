<?php
include("constant.inc");

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Utility
 *
 * @author sk
 */
class Utility {
    //put your code here
    
    private $connection = null;
    
    function __construct() {   
        
       $this->connection  = new PDO(DNS, USERNAME, PASSWORD);
       //This two attributes set below are meant for security
       $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);             
    }    
    
    //This function is going to collect all the continent from the database
    function getcontinents(){
        
        $result = null;
        
        try{
            $statement = "select * from continent";
           $result =  $this->connection->query($statement);           
         
        }
        catch(PDOException $ex){
            echo "An Error occured!"; //user friendly message
            //some_logging_function($ex->getMessage());            
        }
        
        return $result;
    }
    
    function getAllcountriesinContinent($continentid){
        
        try{
            $continentid = (int)$continentid;
        
            $query = "select * from country where ContinentID = ?";
        
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(1, $continentid, PDO::PARAM_INT);
           
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $jsonrecord = json_encode($rows);
            
            return $jsonrecord;
        }
        catch(PDOException $ex){
            
            //You may choose to log errors here
            echo "error";
            return null;            
        }
        
        return null;
    }
    
    
    function getAllStatesofcountry($countryid){
        
        try{
            $query = "select * from state where CountryID = ?";
            
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(1, $countryid, PDO::PARAM_INT);
           
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $jsonrecord = json_encode($rows);
            
            return $jsonrecord;
        }
        catch(PDOException $ex){
            
            //You may choose to log errors here
            echo "error";
            return null;
        }
        
        return null;
    }      
        
}
?>