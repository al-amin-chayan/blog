<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">
    @if(count($professions) > 0)
        @if(!isset($profession_id))
            @php $profession_id = 0 @endphp
        @endif
        <!-- Side Widget Well -->
        <div class="well">
            <h4>Professions (has many through)</h4>
            <div class="list-group">
                @foreach($professions as $profession)
                    <a href="{{ url('/profession/' . $profession->id) }}" class="list-group-item{{ $profession_id == $profession->id ? ' active' : '' }}">
                        <span class="badge">{{ $profession->articles_count }}</span>
                        {{ $profession->name }}
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    @if(count($galleries) > 0)
        @if(!isset($gallery_id))
            @php $gallery_id = 0 @endphp
        @endif
        <!-- Side Widget Well -->
        <div class="well">
            <h4>Video Galleries</h4>
            <div class="list-group">
                @foreach($galleries as $gallery)
                    <a href="{{ url('/gallery/' . $gallery->id) }}" class="list-group-item{{ $gallery_id == $gallery->id ? ' active' : '' }}">
                        <span class="badge">{{ $gallery->videos_count }}</span>
                        {{ $gallery->name }}
                    </a>
                @endforeach
            </div>
        </div>
    @endif

</div>