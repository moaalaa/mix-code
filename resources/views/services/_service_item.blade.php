<div class="s-item" data-aos="fade-up" data-aos-duration="3000" data-aos-anchor-placement="top-center">
    <div class="c-image">
        <img class="service-image-small" src="{{ $service->mainMediaUrlByLang() }}" alt="{{ $service->name_by_lang }}" >
    </div>
    <div class="text">
        <h3>{{ $service->name_by_lang }}</h3>
        
        {!! $service->description_by_lang !!}
        
        <div class="btn-wrapper">
            <a href="{{ route('our_work.show_by_service', $service) }}" class="btn btn-primary btn-work">@lang('site.discover_works')</a>
        </div>
    </div>
</div>