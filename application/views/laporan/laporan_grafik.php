        <div class="block-header">
                      <h1>
                            <ol class="breadcrumb breadcrumb-col-cyan">
                                <li><a href="<?php echo base_url()?>dashboard/index">Home</a></li>
                                <li class="active"><?php echo $title?></li>
                            </ol>    
                      </h1>           
        </div>

    <?php
        if (!empty($bar_chart)) {
            foreach($bar_chart as $result){
                $industri[] = $result->nama; 
                $value[] = (float) $result->jumlah; 
            }     
    ?>
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <div class="row clearfix">
                            <div class="col-xs-12 col-sm-6">
                                <h2> <?php echo $Tabel?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="body">
                     <canvas id="bar_chart" height="150"></canvas>
                    </div>
                </div>
            </div>
        </div>
  <?php
        } 
    ?>

    </div>
</div>
 <!-- Chart Plugins Js -->
    <script src="<?php echo base_url(); ?>adminBSB/plugins/chartjs/Chart.bundle.js"></script>
  <!-- Chart Plugins Js -->
 
  <script>
            var ctx = document.getElementById("bar_chart");
            var myChart = new Chart(ctx, {
                type: 'bar',
                exportEnabled: true,
                data: {
                    labels: <?php echo json_encode($industri);?>,
                    datasets: [{
                            label:  'Data Prakerin' ,
                            data: <?php echo json_encode($value);?>,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.7)',
                                'rgba(54, 162, 235, 0.7)',
                                'rgba(255, 206, 86, 0.7)',
                                'rgba(75, 192, 192, 0.7)',
                                'rgba(153, 102, 255, 0.7)',
                                'rgba(255, 159, 64, 0.7)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,2)',
                                'rgba(54, 162, 235, 2)',
                                'rgba(255, 206, 86, 2)',
                                'rgba(75, 192, 192, 2)',
                                'rgba(153, 102, 255, 2)',
                                'rgba(255, 159, 64, 2)'
                            ],
                            borderWidth: 1
                        }]
                },
                options: {
                    scales: {
                        yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                    }
                }
            });


</script>

