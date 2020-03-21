<?php
    include("Utility.php");
    
    $object = new Utility();
    
    $continentresult = $object->getcontinents();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>World Utility Plugin</title>
       <style type="text/css">
           button{
               color:white;background:red;padding:10px; border:2px;font-weight:200; cursor:pointer;
           }
           .hide{visibility:hidden; }
        
           .loading{
               background:yellow; width:40%; margin-bottom: 20px; margin-left:35%;padding:10px;margin-top:10px;
           }
          select {
                    padding: 5px 10px;
                    margin-bottom: 0;
                    line-height: 1.2;
                    color: #333333;
                    text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
                    cursor: pointer;
                    background-color: #f5f5f5;
                    background-image: -moz-linear-gradient(top, #ffffff, #e6e6e6);
                    background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), to(#e6e6e6));
                    background-image: -webkit-linear-gradient(top, #ffffff, #e6e6e6);
                    background-image: -o-linear-gradient(top, #ffffff, #e6e6e6);
                    background-image: linear-gradient(to bottom, #ffffff, #e6e6e6);
                    background-repeat: repeat-x;
                    border: 1px solid #bbbbbb;
                    border-color: #e6e6e6 #e6e6e6 #bfbfbf;
                    border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
                    border-bottom-color: #a2a2a2;
                    -webkit-border-radius: 4px;
                    -moz-border-radius: 4px;
                    border-radius: 4px;
                    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffffff', endColorstr='#ffe6e6e6', GradientType=0);
                    filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
                    -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
                    -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
                    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
            }
           
       </style>
        
        <script src="jquery-1.7.1.min.js"></script>
        
        <script src="nice_select.min.js"></script>
        
        <script src="linq.min.js"></script>
        <script type="text/javascript">
        
         var countryjson = null;
         
         var statejson = null;
        
        </script>
        <script type="text/javascript" src="script.js"></script>
    </head>
    <body>
        <?php
        // put your code here
        ?>
        
        
        <div class="container">
        
            <div class="header">
                
                <h1>Plugin Would Show Continents, Countries and States Globally</h1>
            </div>
        
            <hr/>
            
            <div class="body">
              <div>
                <span class="loading  hide">Loading information, please wait ......</span>
               </div>
               
                <select name="continent" id="continent">
                    <option value="">Select Continent</option>
                    
                    <?php 
                    
                          while($row = $continentresult->fetch(PDO::FETCH_BOTH)) {
                            
                            echo "<option value='$row[0]'>$row[1]</option>";
                        }
                    
                    ?>
                    
                 </select>
             
                
                <select name="country" id="country">
                    <option value="">Select Country</option>
                    
                 </select>
                
                
                <select name="state" id="state">
                    <option value="">Select State</option>
                    
                 </select>
            </div>
            
            <hr/>
            
            
            <div class="otherinfo">
                
                <h4>Other Information about a Country below</h4>
                <ol>
                    <li>Country : <label id="countrytxt"></label></li>
                    <li>Official Language : <label id="lang"></label></li>
                    <li>Currency : <label id="currency"></label></li>
                    <li>Currency Symbol : <label id="currencysym"></label></li>
                    <li>Dailing Code : <label id="dailcode"></label></li>
                    <li>Capital : <label id="captext">Click button below</label></li>
                </ol>
            </div>
        
            
            <div class="showcap">
              <button id="showcapital">Show Capital city or state </button>
            </div>
        </div>
        
    </body>
</html>