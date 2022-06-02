<div class="column displaybox">
    @include('profil.navprofil')
    <nav class="breadcrumb has-arrow-separator profileback breadcrumbcss" aria-label="breadcrumbs">
        <ul>
            <li><a href="/admin">Admin</a></li>
            <li class="is-active"><a href="">Balas Pertanyaan</a></li>
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
                            <div class="address">
                                <div class="has-text-link has-text-weight-semibold">{{$message->type}}</div>
                            <div class="subtitle is-7">Detail Kontak:<span class="subtitle is-7"> {{$message->name}} | {{$message->email}}
                            <br>
                            <br>
                            <span class="subtitle is-6">Pesan: {{$message->message}}</span>
                            </span></div>
                                <span class="subtitle is-7 has-text-black-bis has-text-weight-bold has-text-right is-pulled-right">Pertanyaan Ditermia: {{$message->created_at->diffForHumans()}}</span></div>
                        </div>
                    </div>
                    <hr style="margin-top: 7%;">
                </div>
                <div class="contetnt">
                    <form action="/admin/pertanyaan/balas" method="post">
                        @csrf
                        <div class="field">
                            <div class="field">
                                <div class="control">
                                    <input class="input control" type="text" placeholder="Masukkan Subjek Pesan" name="subject" required>
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    <input type="hidden" value="0" name="receiverid">
                                    <input type="hidden" value="{{$message->email}}" name="receiver">
                                    <textarea class="textarea {{ $errors->has('message') ? ' is-danger' : '' }}" placeholder="Masukkan Isi Pesan"
                                        name="message"></textarea> {!! $errors->first('message','<p class="help-block has-text-danger">:message</p>') !!}
                                </div>
                            </div>
                            <div>
                                <div class="field">
                                    <div class="control is-pulled-right">
                                        <button class="button is-primary" type="submit">Kirim Pesan</button>
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