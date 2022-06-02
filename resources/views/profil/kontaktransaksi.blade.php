<div class="column displaybox">
        @include('profil.navprofil')
        <nav class="breadcrumb has-arrow-separator profileback breadcrumbcss" aria-label="breadcrumbs">
          <ul>
            <li><a href="/profil">Profil</a></li>
            <li class="is-active"><a href="/profil">Kontak Transaksi</a></li>
          </ul>
        </nav>
        <div class="column profileback upmemargin">
          <div class="columns is-mobile is-centered">
            <div class="column is-half">
        @include('layouts.errors') @if(session()->has('errormsg'))
              <div class="notification is-danger">
                <button class="delete"></button>
                <h1 class="is-size-7"><b> {{ session()->get('errormsg') }}</b></h1>
              </div>
              @endif @if(session()->has('warningmsg'))
              <div class="notification is-warning">
                <button class="delete"></button>
                <h1 class="is-size-7"><b> {{ session()->get('warningmsg') }}</b></h1>
              </div>
              @endif @if(session()->has('success'))
              <div class="notification is-success">
                <button class="delete"></button>
                <h1 class="is-size-7"><b> {{ session()->get('success') }}</b></h1>
              </div>
              @endif
            </div>
            <script>
              document.addEventListener('DOMContentLoaded', () => {
                    (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
                        $notification = $delete.parentNode;
                        $delete.addEventListener('click', () => {
                            $notification.parentNode.removeChild($notification);
                        });
                    });
                });
            </script>
          </div>
          <div class="card cardmargin">
            <div class="containerx">
              <div class="containerx">
                <div class="top">
                  <div>
                    <figure class="image is-64x64 ">
                      <img src="/uploads/avatars/{{$user->avatar}}" alt="Image" class="is-rounded">
                    </figure>
                    <div class="address">
                      <div class="has-text-link has-text-weight-semibold">Penawaran Harga: Rp. {{number_format($offer->offerAmount,2)}}</div>
                      <div class="is-7"><span class="subtitle is-7">Kepada: {{$user->name}}
                            <span class="subtitle is-7 has-text-black-bis has-text-weight-bold"> (User Teregistrasi) </span> 
                        </span>
                      </div>
                      <div class="subtitle is-7">Detail Kontak :<span class="subtitle is-7"> {{$user->email}} | {{$user->phoneNo}}</span></div>
                      <div class="subtitle is-7 is-pulled-right">Terkait :<span class="subtitle is-7"> <a href="/{{strtolower($offer->property->type)}}/{{$offer->property->id}}" target="_blank">Lihat Properti</a></span>
                        <br> 
                      <span class="subtitle is-7 has-text-right">Transaksi Terkirim :<span class="has-text-black-bis has-text-weight-bold">{{$offer->created_at->diffForHumans()}}</span></span></div>
                    </div>
                  </div>
                </div>
                <hr style="margin-top: 7%;">
                <div class="contetnt">
                  <form action="/profil/transaksi/kontak/kirim" method="post">
                    @csrf
                    <div class="field">
                      <div class="field-body">
                        <div class="field">
                          <div class="control">
                            <input type="hidden" value="{{$offer->offeredUser}}" name="owner">
                            <input type="hidden" value="Terkait Transaksi {{$offer->property->name}}" name="subject">
                            <input type="hidden" value="/{{strtolower($offer->property->type)}}/{{$offer->property->id}}" name="path">
                            <textarea class="textarea {{ $errors->has('message') ? ' is-danger' : '' }}" placeholder="Masukkan balasan Anda terkait penawaran ini"
                              name="message"></textarea> {!! $errors->first('message', '
                            <p class="help-block has-text-danger">:message</p>') !!}
                          </div>
                        </div>
                      </div>
                      <br>
                      <div class="field-body">
                        <div class="field">
                          <div class="control is-pulled-right">
                            <button class="button is-primary">
                                Kirim Pesan
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      
      </div>
      </div>
 