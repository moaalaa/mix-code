<div class="row">
    
    {{-- <div class="col-lg-2"></div> --}}

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="text" data-aos="fade-up" data-aos-duration="3000" data-aos-anchor-placement="top-center">
            <h1>{{ getSettings()->call_to_action_by_lang }}</h1>
            <p class="word-break">
                
            </p>
            <div class="btn-wrapper">
                <a href="{{ route('contacts.index') }}" class="btn btn-primary btn-contact">@lang('site.contact_us')</a>
            </div>
        </div>
    </div>
</div>
<div class="soical">
    <ul class="links">
        @if (!! getSettings()->facebook)
            <li>
                <a href="{{ getSettings()->facebook }}" target="_blank">
                    @lang('main.facebook')
                </a>
            </li>
        @endif

        @if (!! getSettings()->linkedin)
            <li>
                <a href="{{ getSettings()->linkedin }}" target="_blank">
                    @lang('main.linkedin')
                </a>
            </li>
        @endif

        @if (!! getSettings()->instagram)
            <li>
                <a href="{{ getSettings()->instagram }}" target="_blank">
                    @lang('main.instagram')
                </a>
            </li>
        @endif

    </ul>
</div>
{{-- <div class="mouse"></div> --}}