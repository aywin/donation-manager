<?php template('header'); ?>

<h1 class="text-center">Statistiques</h1>
<hr />


<div style="width: 60%; float:left">
        <canvas id="canvas" data-years="[<?=implode(',', $lastYears)?>]" data-members="[<?=implode(',', $membersStats)?>]" data-organizations="[<?=implode(',', $organizationsStats)?>]"></canvas>
</div>


<div style="width: 40%; float:right; margin-top: 60px;">
        <div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title">Totals</h3>
		  </div>
        	<div class="panel-body">
        		<table class="table">
        			<tbody>
        				<tr>
        					<td>Total des membres</td>
        					<td><?=App\Models\Member::count()?></td>
        				</tr>
        				<tr>
        					<td>Total des organismes</td>
        					<td><?=App\Models\Organization::count()?></td>
        				</tr>
        			</tbody>
        		</table>
        	</div>
        </div>
</div>

<script src="<?=asset('js/chart.js')?>"></script>
<script src="<?=asset('js/utils.js')?>"></script>
<script src="<?=asset('js/jquery.js')?>"></script>
<script src="<?=asset('js/bootstrap.min.js')?>"></script>

    <script>
        var barChartData = {
            labels: $('#canvas').data('years'),
            datasets: [{
                label: 'Contributions des membres',
                backgroundColor: window.chartColors.red,
                data: $('#canvas').data('members')
            }, {
                label: 'Contributions des organismes',
                backgroundColor: window.chartColors.blue,
                data: $('#canvas').data('organizations')
            }]

        };
        window.onload = function() {
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    title:{
                        display:true,
                        text:""
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false
                    },
                    responsive: true,
                    scales: {
                        xAxes: [{
                            stacked: true,
                        }],
                        yAxes: [{
                            stacked: true
                        }]
                    }
                }
            });
        };

    </script>

		</div>		
	</body>
</html>