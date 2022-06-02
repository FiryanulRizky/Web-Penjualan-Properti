<div class="col-sm-4 col-sm-3 center-responsive">
    <div class="column is-gaps is-12">
        <div class="card">
            <div class="card-image">
                <figure class="image is-4by3">
                    <img src="/uploads/property/{{ $warehouse->property->type }}/{{json_decode($warehouse->property->images)[0]}}" alt="Placeholder image">
                </figure>
            </div>
            <div class="card-content">
                <div class="media">
                    <div class="media-left">
                    </div>
                    <div class="media-content">
                        <p class="is-6">
                            <span class="has-text-dark">Nama :</span> {{$warehouse->property->name}} <br>
                            <span class="has-text-dark">Lokasi :</span> {{$warehouse->property->city}} <br>
                            <span class="has-text-dark">Harga :</span> Rp. {{number_format($warehouse->property->amount,2)}}</p>
                    </div>
                </div>

                <div class="content">
                    <div class="buttons is-pulled-right">
                            <button class="button is-success is-pulled-right" onclick="window.open('/gudang/{{$warehouse->id}}','_blank');">Selanjutnya</button>
                            <button class="button is-warning is-pulled-right" onclick="window.open('/profil/gudang/{{$warehouse->id}}/edit','_blank');">Edit</button>
                            <form action="/profil/gudang/{{$warehouse->id}}/hapus" method="post">
                                @csrf
                                <button class="button is-danger is-pulled-right" type="submit" onclick="deleteMe();">Hapus</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>