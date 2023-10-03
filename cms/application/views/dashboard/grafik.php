<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Visiting Overview
            </div>
            <div class="panel-body">
                <div class="canvas-wrapper">
                    <canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>
                </div>
            </div>
        </div>
    </div>
</div><!--/.row-->
<script>
    <?php 
    print 'var randomScalingFactor = function(){ return Math.round(Math.random()*1000)};';
    print '
            var lineChartData = {
                labels : ["'.$traffic[0]->bulan.'","'.$traffic[1]->bulan.'","'.$traffic[2]->bulan.'","'.$traffic[3]->bulan.'","'.$traffic[4]->bulan.'","'.$traffic[5]->bulan.'","'.$traffic[6]->bulan.'","'.$traffic[7]->bulan.'","'.$traffic[8]->bulan.'","'.$traffic[9]->bulan.'","'.$traffic[10]->bulan.'","'.$traffic[11]->bulan.'"],
                datasets : [
                    {
                        label: "Visit Dataset",
                        fillColor : "rgba(220,220,220,0.2)",
                        strokeColor : "rgba(220,220,220,1)",
                        pointColor : "rgba(220,220,220,1)",
                        pointStrokeColor : "#fff",
                        pointHighlightFill : "#fff",
                        pointHighlightStroke : "rgba(220,220,220,1)",
                        data : ['.$traffic[0]->jumlah.','.$traffic[1]->jumlah.','.$traffic[2]->jumlah.','.$traffic[3]->jumlah.','.$traffic[4]->jumlah.','.$traffic[5]->jumlah.','.$traffic[6]->jumlah.','.$traffic[7]->jumlah.','.$traffic[8]->jumlah.','.$traffic[9]->jumlah.','.$traffic[10]->jumlah.','.$traffic[11]->jumlah.']
                    }
                ]
            }';
    ?>
</script>

<script>
	window.onload = function() {
		var chart1 = document.getElementById("line-chart").getContext("2d");
		window.myLine = new Chart(chart1).Line(lineChartData, {
			responsive: true,
			scaleLineColor: "rgba(0,0,0,.2)",
			scaleGridLineColor: "rgba(0,0,0,.05)",
			scaleFontColor: "#c5c7cc"
		});
	};
</script>