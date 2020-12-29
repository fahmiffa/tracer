<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
          <div class="card-icon shadow-primary bg-primary">
            <i class="fas fa-users"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Alumni</h4>
            </div>
            <div class="card-body">
              9
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
          <div class="card-icon shadow-primary bg-primary">
            <i class="fas fa-dollar-sign"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Lowongan Pekerjaan</h4>
            </div>
            <div class="card-body">
              5
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
          <div class="card-icon shadow-primary bg-primary">
            <i class="fas fa-user"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Registrasi Alumni</h4>
            </div>
            <div class="card-body">
              8
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <!-- <div class="card-header">
          </div> -->
          <div class="card-body">
            <div id="piechart"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>



<script type="text/javascript">
  // Load google charts
  google.charts.load('current', {
    'packages': ['corechart']
  });
  google.charts.setOnLoadCallback(drawChart);

  // Draw the chart and set the chart values
  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Task', 'Hours per Day'],
      ['Bekerja', 10],
      ['Berwirusaha', 4],
      ['Belum Bekerja', 10],
    ]);

    // Optional; add a title and set the width and height of the chart
    var options = {
      'title': 'Grafik Status Alumni',
      'width': 550,
      'height': 400
    };

    // Display the chart inside the <div> element with id="piechart"
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, options);
  }
</script>