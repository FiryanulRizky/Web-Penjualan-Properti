<div class="col-sm-4 col-sm-3 center-responsive">
        <div class="column is-gaps is-12">
            <div class="card">
                <div class="card-image">
                    <figure class="image is-4by3">
                        <img src="/uploads/property/{{$house->property->type}}/{{json_decode($house->property->images)[0]}}" alt="Placeholder image">
                    </figure>
                </div>
                <div class="card-content">
                    <div class="media">
                        <div class="media-left">
                            <figure class="image is-48x48">
                                <img src="/uploads/avatars/{{$house->property->user->avatar}}" class="is-rounded" alt="Placeholder image">
                            </figure>
                        </div>
                        <div class="media-content">
                            <p class="subtitle is-5 has-text-dark has-text-weight-medium">{{$house->property->name}}</p>
                            <p class="title is-4 has-text-dark">Rp. {{number_format($house->property->amount,2)}}</p>
                            <p class="subtitle is-6 has-text-link"><span>@</span>{{$house->property->user->name}}</p>
                        </div>
                    </div>
    
                    <div class="content">
                        {{Str::limit(str_replace("&nbsp;",'',strip_tags($house->property->description)),100)}}
                        <br>
                        <time datetime="2016-1-1">{{$house->created_at->isoFormat('LLLL')}}</time>
                        <a href="/rumah/{{$house->id}}"><button class="button is-link is-pulled-right">Selengkapnya</button></a>
                    </div>
                </div>
            </div>
        </div>
</div>