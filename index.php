<!DOCTYPE html>
<html lang="en" ng-app>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>kcatulator</title>
  
  <link href="css/animate.min.css" rel="stylesheet"> 
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/lightbox.css" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">
  <link id="css-preset" href="css/presets/preset1.css" rel="stylesheet">
  <link href="css/responsive.css" rel="stylesheet">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="src/bootstrap3-typeahead.js"></script>
  <script src="src/bootstrap3-typeahead.min.js"></script>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
  
  
  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
  <![endif]-->
  
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
  
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.0/angular.min.js"></script>
  <script src="src/Chart.bundle.min.js"></script>
  <link rel="shortcut icon" href="images/favicon.ico">
  
</head><!--/head-->
<body class="Header">
<div></div>
  <!--.preloader-->
  <div class="preloader"> <i class="fa fa-circle-o-notch fa-spin"></i></div>
  <!--/.preloader-->
    <div>	
    	<img id="KcatImg" src="images/logo_kcatulator.png" alt="Kcatulator" height="150" width="500">
        <div class="row">
          <div class="heading text-center col-sm-6 col-sm-offset-3">
            <input id="EnzymeInput" type="text" class="typeahead my-form-control" placeholder="Type a name of an enzyme"  style="color: white;"/> 
            </div>
        </div>
    </div>        
 
 <div class="box col-sm-6 col-sm-offset-3">
    <h3>Reaction</h3>
    <p class="ReactionColor">
    	  <div id="list ReactionColor">
      		<div class="heading ReactionColor">  	<!--<div class="heading wow fadeInUp ReactionColor" data-wow-duration="1000ms" data-wow-delay="300ms">-->
          		<div class="text-center col-sm-6 col-sm-offset-3 ReactionColor">
					<ul id="reactions" class="w3-ul w3-hoverable" style="padding-top:20px;"></ul>
          		</div>
        	</div> 
      </div>
        </p>
</div>

<div id="organisms" class="container"></div>

<div id ="tabs" class="container">
  <ul class="nav nav-tabs">
    <li class="active w3-animate-zoom"><a data-toggle="tab" href="Kapp">Kapp</a></li>
    <li><a data-toggle="tab w3-animate-zoom" href="#Flux">Flux</a></li>
    <li><a data-toggle="tab w3-animate-zoom" href="#EA">Enzyme Amount</a></li>
  </ul>

  <div class="tab-content">
    <div id="Kapp" class="tab-pane fade in active">
        <section id="graphs">
			<div class="container pricing-table">
				<div id="graph_container" class="heading text-center col-sm-8 col-sm-offset-2" wow fadeInUp" data-wow-duration="1200ms" data-wow-delay="300ms">
				<canvas class="single-table" id="canvas" ></canvas>
				</div>
			</div>
		</section>
    </div>
    
    <div id="Org2" class="tab-pane fade">
     	<section id="graphs1">
			<div class="container pricing-table">
				<div id="graph_container1" class="heading text-center col-sm-8 col-sm-offset-2" wow fadeInUp" data-wow-duration="1200ms" data-wow-delay="300ms">
				<canvas class="single-table" id="canvas1" ></canvas>
				</div>
			</div>
		</section>
    </div>
</div>
</div>
</div>
</body>
 

  <script>
  
  
   		Chart.defaults.global.responsive = true;	
		var gene;
		var Org;
			// Gets list of all genes to the searchable textbox
			$(function() {
				$.post("GetGenes.php", function(data, status){
				  var Genes = JSON.parse(data);
				  
				  
		      // This is running when someone clicks on a gene
		      // Display reactions of chosen gene name
				  function displayResult(item) {
						gene = item.substring(0,item.lastIndexOf('-') - 1);
						$.post("GetReactions.php", {data: gene}, function(result, status){
					    	var res = JSON.parse(result);
								$.post("GetOrganism.php", {data: gene}, function(result, status)
									 {
	                          			 Org = JSON.parse(result);   
	                                                                            				  
					    					$('#reactions').empty();
					   						for (var i = 0; i < res.length; i++) {
												var reaction = res[i].substr(0,res[i].lastIndexOf('-') - 1);
						    						$('#reactions').append("<li class='list-group-item' id='reaction_" + i + "'>" + res[i] + "</li>");
													}
						  					$("#list").show();
											$("#graphs").hide(); 		
					   				});	
								});
				           }
				
				  $('#EnzymeInput').typeahead
				  (
					{
					name:'test1',
					  fitToElement: true,
					  minLength: 2,
					  scrollHeight :15,
					  items:3,
				      source: Genes,
				      updater: function (GeneName) {
						/* do whatever you want with the selected item */
	 					displayResult(GeneName);
						},
				    }
				    
				    
				     
				  ).focus();
			});
		});
          

			
			// This is running when someone click a reaction
			$('ul').on('click', 'li', function() {
		    var reaction = $(this).text();
		    var line = this.id;
		    var FirstTab=document.getElementsByName("home");
		    FirstTab.value= Org[0]
 			 $("#tabs").show();	
 			 
 			 
		    reaction = reaction.substr(0,reaction.lastIndexOf('-') - 1);					    
				$('li').css('background-color', '#FFF');
				$('#' + line).css('background-color', '#00BFFF');
								
				//$('#canvas').remove(); // this is my <canvas> element
				//$('#graph-container').append("<canvas class='single-table' id='canvas' ></canvas>");
			var FluxArr =[];     
			
		    $.post("GetGraphs.php", {data: gene, Organism: Org[0]}, function(graph_data, status){
		    	
		    	var htmlElements = "";
				for (var i = 0; i < Org.length; i++)
				{
   				htmlElements += '  <div class="box col-sm-6 col-sm-offset-3" style="padding-top:50px;"> <h3>' + Org[i] +'</h3> <p> TTTT </p> </div>';
   				
   				
   				
   				
   				
				}
				var container = document.getElementById("organisms");
				container.innerHTML = htmlElements;
		    	
		    	
		    	
		    	
			        var ConditionData = JSON.parse(graph_data);
					var CondNameArr = [];
					var Enzyme_Amount_Arr = [];
					var FluxArr =[];        
				    $.each(ConditionData, function(key, value)
				    {
				    temp = value.split("-")
				    CondNameArr.push(key)	
				    Enzyme_Amount_Arr.push(temp[0])
				    FluxArr.push(temp[1])
    			   //display the key and value pair
    			  // alert(key + ' is '+ temp[0]  + ' flux: ' +  temp[1]);
					});
					
			        // var acetate = parseFloat(ConditionData.acetate);
			        // var pyruvate = parseFloat(ConditionData.pyruvate);
			        // var glycerol = parseFloat(ConditionData.glycerol); 
			        // var fructose = parseFloat(ConditionData.fructose);
			        // var succinate = parseFloat(ConditionData.succinate); 
			        // var glucose = parseFloat(ConditionData.glucose);

	   	       		var ctx = document.getElementById("canvas").getContext("2d");
	   	       		
							var dat = {
									labels: [CondNameArr[0], CondNameArr[1], CondNameArr[2], CondNameArr[3], CondNameArr[4], CondNameArr[5], CondNameArr[6]],
									datasets: [
											{
													label: Org[0],
													 backgroundColor: [
             										   'rgba(255, 99, 132, 0.2)',
             										   'rgba(54, 162, 235, 0.2)',
              										   'rgba(255, 206, 86, 0.2)',
               										   'rgba(75, 192, 192, 0.2)',
                									   'rgba(153, 102, 255, 0.2)',
               										   'rgba(255, 159, 64, 0.2)'
           										 ],
													//fillColor: ["rgba(220,220,220,0.5)", "navy", "red", "orange", "blue", "red", "white"],
													strokeColor: "rgba(220,220,220,1)",
													pointColor: "rgba(220,220,220,1)",
													pointStrokeColor: "#fff",
													pointHighlightFill: "#fff",
													pointHighlightStroke: "rgba(220,220,220,1)",
													data: [Enzyme_Amount_Arr[0], Enzyme_Amount_Arr[1], Enzyme_Amount_Arr[2], Enzyme_Amount_Arr[3], Enzyme_Amount_Arr[4], Enzyme_Amount_Arr[5], Enzyme_Amount_Arr[6]]
											}
									]
							};

							
							var myNewChart = new Chart(ctx , {
									type: "bar",
									data: dat, 	
									options: {
  										scales: {
  									 		yAxes: [{
      											scaleLabel: {
       											 	display: true,
										         	labelString: 'Kapp [S]'
												      		}
    												}]
 												}
											}
									});
			       
			        
				      $("#graphs").show();		
				    });
				    
				    
				    $.post("GetGraphs.php", {data: gene, Organism: Org[1]}, function(graph_data, status){
			         var ConditionData = JSON.parse(graph_data);
					var CondNameArr = [];
					var Enzyme_Amount_Arr = [];        
				    $.each(ConditionData, function(key, value)
				    {
				   	 	temp = value.split("-")
				    	CondNameArr.push(key)	
				   	 	Enzyme_Amount_Arr.push(temp[0])
				   	 	FluxArr.push(temp[1])
					});

	   	       		var canvas = document.getElementById("canvas1");
					var ctx = canvas.getContext("2d");

							var dat = {
									labels: [CondNameArr[0], CondNameArr[1], CondNameArr[2], CondNameArr[3], CondNameArr[4], CondNameArr[5], CondNameArr[6]],
									datasets: [
											{
													label: Org[1],
													 backgroundColor: [
             										   'rgba(255, 99, 132, 0.2)',
             										   'rgba(54, 162, 235, 0.2)',
              										   'rgba(255, 206, 86, 0.2)',
               										   'rgba(75, 192, 192, 0.2)',
                									   'rgba(153, 102, 255, 0.2)',
               										   'rgba(255, 159, 64, 0.2)'
           										 ],
													//fillColor: ["rgba(220,220,220,0.5)", "navy", "red", "orange", "blue", "red", "white"],
													strokeColor: "rgba(220,220,220,1)",
													pointColor: "rgba(220,220,220,1)",
													pointStrokeColor: "#fff",
													pointHighlightFill: "#fff",
													pointHighlightStroke: "rgba(220,220,220,1)",
													data: [Enzyme_Amount_Arr[0], Enzyme_Amount_Arr[1], Enzyme_Amount_Arr[2], Enzyme_Amount_Arr[3], Enzyme_Amount_Arr[4], Enzyme_Amount_Arr[5], Enzyme_Amount_Arr[6]]
											}
									]
							};

							
							var myNewChart = new Chart(ctx , {
									type: "bar",
									data: dat, 
							});
			       
			        
				      $("#graphs1").show();		
				    });
				    
				    
			});
      
      $( document ).ready(function(){
    $("#list").hide();
    $("#graphs").hide();
    $("#tabs").hide();	
    document.getElementById("EnzymeInput").focus();
    
    $("#EnzymeInput").bind('blur keyup',function(e) {  
          if (e.type == 'blur' || e.keyCode == '13') {
          } 
     });  
    
    
});
      
  </script>


  <script type="text/javascript" src="js/canvasjs.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/jquery.inview.min.js"></script>
  <script type="text/javascript" src="js/wow.min.js"></script>
  <script type="text/javascript" src="js/mousescroll.js"></script>
  <script type="text/javascript" src="js/smoothscroll.js"></script>
  <script type="text/javascript" src="js/jquery.countTo.js"></script>
  <script type="text/javascript" src="js/lightbox.min.js"></script>
  <script type="text/javascript" src="js/main.js"></script>

</body>
</html>
