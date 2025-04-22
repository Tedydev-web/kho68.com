<div class="owl-carousel owl-theme mt-5" style="border-radius: 10px">
    @foreach ($banners as $banner)
        <div class="item" style="border-radius: 10px">
            <a href="{{ $banner->link }}" target="_blank">
                <img style="border-radius: 10px" src="{{ Storage::url($banner->media->path) }}"
                     alt="{{ $banner->title }}" class="img-fluid">
            </a>
            @if ($banner->description)
                <div class="banner-description">
                    {{ $banner->description }}
                </div>
            @endif
        </div>
    @endforeach
</div>
