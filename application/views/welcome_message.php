<div class="container">

  <div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">
	<?php 
	$hc=0;
	$ht=0;
	$mc=0;
	$mt=0;
	$nb=0;
	foreach ($subtitulodb as $dbtitulo) {
             $titulo= $dbtitulo->nome;
           }
	foreach ($dadoschart as $dados){
		
		$sexo= $dados->sexo;
		
		if ($sexo=="Homem Cis")
		{
			$hc++;
		}
		if ($sexo=="Homem Trans")
		{
			$ht++;
		}
		if ($sexo=="Mulher Cis")
		{
			$mc++;
		}
		if ($sexo=="Mulher trans")
		{
			$mt++;
		}
		if ($sexo=="Nao Binario")
		{
			$nb++;
		}

	}
	?>


	<!--Load the AJAX API-->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
        	['Homem Cis', <?php echo $hc;?>],
        	['Homem Trans', <?php echo $ht;?>],
        	['Mulher Trans', <?php echo $mt;?>],
        	['Mulher Cis', <?php echo $mc;?>],
        	['Não-Binário', <?php echo $nb;?>]
        	]);

        // Set chart options
        var options = {'title':'Porcentagem de ocorrências por gênero',
        'width':400,
        'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>
<h1><?php echo $dbtitulo->nome?> </h1>
<hr>
	<!--Div that will hold the pie chart-->
	<div id="chart_div"></div>
	

</div>