$(document).ready(function (){
        
    $('#continent').on('change', function (){        
        var value = $(this).val();
        value = $.trim(value);
        
        //clear the previous json
        statejson = null;
        
        if(value.length >0){            
           $.ajax({
            url: "Processor.php",
            cache: false,
            data: {
                continentid: value,
                getcountries:1
            },
            async: true,
            type: "POST",
            dataType: "json",
            beforeSend: function (xhr) {
                 clearInfo();
                $('.loading').removeClass('hide');
            },
            complete: function (xhr, status) {

                $('.loading').addClass('hide');
            },
            success: function (result) {

                displayCountries(result);
            },
            error: function (xhr, status, error) {
                alert(error);
            }
          });
       }     
       else{
           
           
       }
    });
    
    
    function displayCountries(obj){
        
        var optionvalue = "<option value=''>Select Country</option>";
        if(obj != null){
            
            //we would first pass the json result into our global object, so we can query with linq to javascript library
            countryjson = obj;
            
            for(var k = 0;k< obj.length; k++){
                
                optionvalue += "<option value='"+obj[k].CountryID+"'>"+obj[k].Name+"</option>";
            }
        }        
        
        $('#country').html(optionvalue);
    }
    
    
    $('#country').on('change',function (){
        
        var value = $(this).val();
        value = $.trim(value);
        
        if(value.length >  0){
            $('#captext').text('');
            $.ajax({
            url: "Processor.php",
            cache: false,
            data: {
                countryid: value,
                getstates:1
            },
            async: true,
            type: "POST",
            dataType: "json",
            beforeSend: function (xhr) {

                $('.loading').removeClass('hide');
            },
            complete: function (xhr, status) {

                $('.loading').addClass('hide');
            },
            success: function (result) {
                 getcountryinfo(value);
                displayStates(result);
                
            },
            error: function (xhr, status, error) {
                alert(error);
            }
          });         
        }  
    });
    
    
    function displayStates(obj){
        
        var optionvalue = "<option value=''>Select State</option>";
        
        if(obj != null){            
            statejson = obj;            
            for(var k=0; k<obj.length; k++){                
                optionvalue += "<option value='"+obj[k].StateID+"'>"+obj[k].Name+"</option>";
            }          
        }        
        $('#state').html(optionvalue);
    }    
    
    function getcountryinfo(countryid){
        var queryResult = Enumerable.From(countryjson)
    .Where(function (x) { return x.CountryID == countryid })   
    .Select(function (x) { return x}).FirstOrDefault();
    
    //display the country distails on the show panel
    $('#countrytxt').text(queryResult.Name); 
    $('#lang').text(queryResult.OfficialLanguage);
    $('#currency').text(queryResult.Currency);
    $('#currencysym').text(queryResult.CurrencySymbol);
    $('#dailcode').text(queryResult.Dialingcode);
    }
    
    function clearInfo(){
         //display the country distails on the show panel
        $('#countrytxt').text(''); 
        $('#lang').text('');
        $('#currency').text('');
        $('#currencysym').text('');
        $('#dailcode').text('');
         $('#captext').text("Click button below");
    }
    
    $('#showcapital').on('click', function (){    
     if(statejson == null || statejson.length < 1){
          alert("Ensure that you have selected a country before clicking this button");
      }
      else{
          var countryid= $('#country').val();
          getstatecapital(countryid);
      }
});

  function getstatecapital(countryid){
        var queryResult = Enumerable.From(statejson)
    .Where(function (x) { return  x.IsCapital == 1 })   
    .Select(function (x) { return x.Name }).FirstOrDefault();
   
    $('#captext').text(queryResult);
  }
});
