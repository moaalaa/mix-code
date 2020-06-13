@extends('dashboard.layouts.app')

@section('section', $sectionName)

@section('content')


    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $sectionName }}</h1>
        <div>
                {{-- @if ($notification->read())
                    <a href="{{ route('dashboard.notifications.mark_as_unread', $notification) }}" class="d-sm-inline-block btn btn-sm btn-warning shadow-sm mr-1">
                        <i class="fas fa-eye-slash fa-sm text-white"></i>
                    </a>
                @else
                    <a href="{{ route('dashboard.notifications.mark_as_read', $notification) }}" class="d-sm-inline-block btn btn-sm btn-success shadow-sm mr-1">
                        <i class="fas fa-eye fa-sm text-white"></i>
                    </a>
                @endif --}}
            
        </div>
    </div>
    
    <!-- Content Row -->
    <div class="row">
    
        
        <div class="col-xl-12 col-md-12 col-sm-12 mb-5">
            <div class="card">
                <div class="card-body border-left-success">
                    <div class="card-title">
                        @lang('main.new_order_requested', ['sender' => $notification->data['sender']])
                    </div>
                    
                    <a href="{{  route('dashboard.checkouts.show', $notification->data['checkout_id'])  }}">@lang('site.checkout')</a>
                </div>
            </div>
        </div>
        
    </div>
    

@endsection