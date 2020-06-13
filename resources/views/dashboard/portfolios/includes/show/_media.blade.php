<div class="grid d-flex">
    @php
        $media = $portfolio->allMedia();
    @endphp

    <div class="grid-col grid-col--1"></div>
    <div class="grid-col grid-col--2 d-sm-none d-md-block"></div>
    <div class="grid-col grid-col--3 d-sm-none d-lg-block"></div>
    <div class="grid-col grid-col--4"></div>
    
    @foreach ($media as $image)
        <div class="card grid-item image-container">
            <img class="card-img portfolio-image" src="{{ $image->getUrl() }}">
                
            <button type="button" class="btn btn-danger btn-sm delete-image" data-id="{{ $image->id }}">
                <i class="fas fa-trash"></i>
            </button>

        </div>
    @endforeach

</div>