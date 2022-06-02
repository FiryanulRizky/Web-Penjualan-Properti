<div class="modal off" id="offer">
  <div class="modal-background"></div>
  <div class="modal-card">
      <header class="modal-card-head">
          <p class="modal-card-title has-text-centered">Masukkan Penawaran Harga dari Anda</p>
          <button class="delete closeoffer" aria-label="close"></button>
      </header>
      <section class="modal-card-body">
      <p class="subtitle is-6 has-text-centered"><strong class="has-text-danger">Penting : Penawaran Harga Anda harus lebih tinggi dari penawaran saat ini</strong></p>
      <form action="/gedung/{{$building->id}}/transaksi" method="post">
          @csrf
          <div class="field">
              <div class="control column is-8 is-offset-2">
                  <input class="input is-7" name="offeramount" type="text" placeholder="Masukkan Penawaran Harga dari Anda">
                  <input name="propertyid" type="text" value="{{$building->property_id}}" hidden>
                  <input name="buildingid" type="text" value="{{$building->id}}" hidden>
              </div>
          </div>
          <div class="field is-centered has-text-centered">
              <button type="submit" class="button is-info"><span class="savebutton">Kirim</span></button>
          </div>
      </form>
      </section>
      <footer class="modal-card-foot is-centered has-text-centered">
        <p class="subtitle is-7 has-text-centered">Jika melakukan pembayaran, kami menyarankan Anda memiliki dua metode kontak permanen & terverifikasi dari penerima pembayaran seperti nomor telepon rumah dan alamat rumah/bisnis mereka.
        </p>
      </footer>
  </div>
</div>

{{-- JS Script for popup --}}
<script>
  var modal = document.getElementById('offer');
  var btn = document.getElementById("myBtn");
  var span = document.getElementsByClassName("closeoffer")[0];
  btn.onclick = function() {
      document.querySelector('.off').style.display = 'block';
  }
  span.onclick = function() {
      document.querySelector('.off').style.display = 'none';
  }
  window.onclick = function(event) {
      if (event.target == modal) {
          document.querySelector('.off').style.display = 'none';
      }
  }
</script>
{{-- Tablet View Submit --}}
<script>
  var modal = document.getElementById('offer');
  var btn = document.getElementById("myBtnM");
  var span = document.getElementsByClassName("closeoffer")[0];
  btn.onclick = function() {
      document.querySelector('.off').style.display = 'block';
  }
  span.onclick = function() {
      document.querySelector('.off').style.display = 'none';
  }
  window.onclick = function(event) {
      if (event.target == modal) {
          document.querySelector('.off').style.display = 'none';
      }
  }
</script>