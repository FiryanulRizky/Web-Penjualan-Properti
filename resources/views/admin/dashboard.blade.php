<script type="text/javascript" src="/js/googlecharts.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

      var data = google.visualization.arrayToDataTable({!! $data !!},false);
      var options = {'title':'Persentase Jenis Properti', 'width':450,'height':400};
      var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
      chart.draw(data, options);

    }
    </script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

      var data = google.visualization.arrayToDataTable({!! $graphUserData !!},false);
      var options = {'title':'Registrasi User Bulanan', 'width':300,'height':200};
      var chart = new google.visualization.PieChart(document.getElementById('chart_month'));
      chart.draw(data, options);

    }
    </script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

      var data = google.visualization.arrayToDataTable({!! $graphUserProvince !!},false);
      var options = {'title':'Persentase Kabupaten', 'width':300,'height':200};
      var chart = new google.visualization.PieChart(document.getElementById('chart_province'));
      chart.draw(data, options);

    }
    </script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart', 'bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

      var data = google.visualization.arrayToDataTable({!! $graphReportData !!},false);
      var options = {title: 'Jumlah Report Bulanan',
                    chartArea: {width: '50%'},
                    hAxis: {
                      title: 'Total Report',
                      minValue: 0
                    },
                    vAxis: {
                      title: 'Bulan'
                    },'width':300,'height':200};
      var chart = new google.visualization.BarChart(document.getElementById('chart_report'));
      chart.draw(data, options);

    }
    </script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

      var data = google.visualization.arrayToDataTable({!! $graphAvailabilityData !!},false);
      var options = {'title':'Properti Berdasarkan Ketersediaan', 'width':300,'height':200};
      var chart = new google.visualization.PieChart(document.getElementById('chart_availability'));
      chart.draw(data, options);

    }
    
    </script>
<div class="column displaybox profileback">
  @include('admin.navprofile')
  <nav class="breadcrumb has-arrow-separator profileback breadcrumbcss" aria-label="breadcrumbs">
    <ul>
      <li><a href="/admin">Admin</a></li>
      <li class="is-active"><a href="/admin">Dashboard</a></li>
    </ul>
  </nav>
  <div class="subtitle has-text-black-bis">Lihat Ringkasan</div>
  <div class="columns">
    <div class="column">
        <div id="chart_div">
        </div>
    </div>
    <div class="column">
        <div class="columns">
          <div class="column" id="chart_province"></div>
          <div class="column" id="chart_month"></div>
        </div>
        <div class="columns">
          <div class="column" id="chart_report">
          </div>
          <div class="column" id="chart_availability"></div>
        </div>
    </div>
  </div>
  <hr>
  <div class="subtitle has-text-black-bis">Properti Terakhir</div>
  <div class="column tableshow" style="overflow-x: auto">
    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>ID Properti</th>
          <th>Nama Properti</th>
          <th>Lokasi Properti</th>
          <th>Jenis Properti</th>
          <th>Harga Properti</th>
          <th>Ditambah Oleh</th>
          <th>Lihat</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>No</th>
          <th>ID Properti</th>
          <th>Nama Properti</th>
          <th>Lokasi Properti</th>
          <th>Jenis Properti</th>
          <th>Harga Properti</th>
          <th>Ditambah Oleh</th>
          <th>Lihat</th>
        </tr>
      </tfoot>
      <tbody>
        @foreach ($properties as $key=>$property)
        <tr>
          <td>{{$key+1}}</td>
          <td>{{$property->id}}</td>
          <td>{{$property->name}}</td>
          <td>{{$property->city}}</td>
          <td>{{$property->type}}</td>
          <td>{{number_format($property->amount,2)}}</td>
          <td>{{$property->user->name}}</td>
          <td><a href="/admin/{{strtolower($property->type)}}/{{$property->id}}" class="button is-success nounnounderlinebtn"
              target="_blank">Lihat</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <hr>
  <div class="subtitle has-text-black-bis">Registrasi User Terakhir</div>
  <div class="column tableshow style=" overflow-x: auto ">   
            <table class="table ">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Id User</th>
                  <th>Nama User</th>
                  <th>Email User</th>
                  <th>Kelengkapan Profil</th>
                  <th>Status</th>
                  <th>Lihat User</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>Id User</th>
                  <th>Nama User</th>
                  <th>Email User</th>
                  <th>Kelengkapan Profil</th>
                  <th>Status</th>
                  <th>Lihat User</th>
                </tr>
              </tfoot>
              <tbody>
                @foreach ($users as $key=>$user)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        @if($user->NIC==null || $user->description==null || $user->address==null || $user->city==null || $user->gender==null || $user->NIC==null || $user->birthday==null || $user->phoneNo==null)
                          Lengkap
                        @else
                          Belum Lengkap
                        @endif
                    </td>
                    <td>
                      @if($user->email_verified_at==NULL)
                        Belum Terverifikasi
                      @else
                        Terverifikasi
                      @endif
                    </td>
                  <td><a href="/admin/user/{{$user->id}}/tampil" class="button is-info nounnounderlinebtn" target="_blank">Lihat User</a>
    </td>
    </tr>
    @endforeach
    </tbody>
    </table>
  </div>
</div>