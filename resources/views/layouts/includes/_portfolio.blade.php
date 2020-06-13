<div class="container">
    <div class="row">
        <div class="col-xl-9 col-lg-9 col-md-8 col-sm-12 col-xs-12">
            <div class="heading" data-aos="fade-up" data-aos-duration="3000" data-aos-anchor-placement="top-center">
                <h3 class="title">@lang('site.latest_work')</h3>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-xs-12">
            <div class="btn-wrapper">
                <a href="{{ route('our_work.index') }}" class="btn btn-primary btn-all">@lang('site.discover_our_work')</a>
            </div>
        </div>
    </div>
    <div class="row justify-content-around">
        @foreach ($portfolio_services as $portfolio_service)
            @php
                $work = $portfolio_service->latestWork;
            @endphp
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="p-item" data-aos="flip-up" data-aos-duration="3000" data-aos-anchor-placement="top-center">
                    <div class="image">
                        <a href="{{ route('our_work.show', $work) }}">
                            <img class="our-work-large" src="{{ $work->mainMediaUrl() }}" alt="{{ optional($work->client)->name_by_lang }}">
                        </a>
                    </div>
                    <div class="text">
                        <h6>
                            <a href="{{ route('our_work.show', $work) }}">{{ optional($work->client)->name_by_lang }} - {{ optional($portfolio_service->latestWork->service)->name_by_lang }}</a>
                        </h6>
                    </div>
                </div>
            </div>        

        @endforeach
    </div>  
</div>