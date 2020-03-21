<?php
include("Utility.php");
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



class Processor{
    
    private $objectutility = null;
    
    function __construct() {
        
        $this->objectutility = new Utility();
               
    }
    
    public function CollectCountries(){
        
        $continentid = trim($_POST['continentid']);  //This is going to clear out any white space
        
       $jsonresult =  $this->objectutility->getAllcountriesinContinent($continentid);
       
       echo $jsonresult;
    }
    
    
    public function CollectStates(){
        
        $countryid = trim($_POST['countryid']);
        
        $jsonresult = $this->objectutility->getAllStatesofcountry($countryid);
        
        echo  $jsonresult;
    }
    
}


$object = new Processor();

if(isset($_POST["getcountries"])){
           
    $object->CollectCountries();
}

if(isset($_POST["getstates"])){
    
    $object->CollectStates();
}

if($_GET){
    
    header("Location: index.php");
    exit;
}

?>