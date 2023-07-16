@forelse($data_spesies as $item)
          
<div class="col-xl-6">
<a href="{{url('/explorer-detail/'.$item->id)}}">
    <div class="blog-item">
        <div class="blog-thumb set-bg" data-setbg="{{$item->getImage()}}" style="max-width: 286px; max-height: 190px; object-fit: cover; object-position: center;"></div>
        <div class="blog-content">
            <h4>{{ $item->nama_umum }}</h4>
            <span>( <em> {{ $item->nama_latin }} </em> )</span>
            <div class="blog-meta">
                <span><i class="fa fa-calendar-o"></i> ( <em> {{ $item->created_at }} </em> )</span>
                <span><i class="fa fa-user"></i> {{$item->user_id}}</span>
            </div>
            <!-- <p>Integer luctus diam ac scerisque consectetur. Vimus dot euismod neganeco lacus sit amet. Aenean interdus mid vitae sed accumsan...</p> -->
        </div>
    </div>
</a>
</div>
@empty
<p><center> Data Tidak Ditemukan </center> </p>
@endforelse