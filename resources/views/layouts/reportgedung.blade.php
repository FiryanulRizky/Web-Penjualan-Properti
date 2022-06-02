<div class="modal repo" id="reportModal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title has-text-centered">Laporkan Iklan Properti ini</p>
      <button class="delete closeme" aria-label="close"></button>
    </header>
    <section class="modal-card-body">
      <form action="/gedung/{{$building->id}}/report" method="post">
        @csrf
        <div class="field">
          <div class="control column is-8 is-offset-2">
            <label for="email">Email</label>
            <input name="propertyid" type="text" value="{{$building->property_id}}" hidden>
            <input name="buildingid" type="text" value="{{$building->id}}" hidden>
            <input class="input is-7 is-info" name="email" type="email" placeholder="Masukkan Email Anda" required>
          </div>
          <div class="control column is-8 is-offset-2">
            <label for="email">Alasan Pelaporan</label>
            <textarea class="textarea  is-7 is-info" name="reason" type="text" placeholder="Tolong beri tahu kami mengapa Anda ingin melaporkan iklan ini" rows="3" required></textarea>
          </div>
        </div>
        <div class="field is-centered has-text-centered">
          <button type="submit" class="button is-danger"><span class="savebutton">Laporkan Iklan</span></button>
        </div>
      </form>
    </section>
    <footer class="modal-card-foot is-centered has-text-centered">
      <p class="subtitle is-7 has-text-centered" style="margin-left: 12%;">Terima kasih atas laporan Anda, staf kami akan memeriksa laporan ini dan mengambil tindakan lebih lanjut. <br> <strong>E-Commerce Property</strong></p>
    </footer>
  </div>
</div>


{{-- JS Script for popup --}}
<script>
  var modal = document.getElementById('reportModal');
    var btn = document.getElementById("report");
    var span = document.getElementsByClassName("closeme")[0];
    btn.onclick = function() {
      document.querySelector('.repo').style.display = 'block';
    }
    span.onclick = function() {
      modal.style.display = "none";
    }
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }

</script>