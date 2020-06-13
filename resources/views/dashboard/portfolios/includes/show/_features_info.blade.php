<div class="row">
    <div class="col-xl-4 col-md-4 col-sm-12 mb-3">
        <div class="card  border-left-danger">
    
            <div class="card-title font-weight-bold h5 text-center text-danger my-2">@lang('main.categories')</div>
             
            <ul class="list-group list-group-flush">
                @foreach ($card->categories as $category)
                    
                    <a href="{{ $category->path() }}" class="list-group-item list-group-item-action" target="_blank">{{ $category->name_by_lang }}</a>
                    
                @endforeach
            </ul>
            
        </div>
    </div>
   
    <div class="col-xl-4 col-md-4 col-sm-12 mb-3">
        <div class="card  border-left-danger">
    
            <div class="card-title font-weight-bold h5 text-center text-danger my-2">@lang('main.companies')</div>
                
            <ul class="list-group list-group-flush">
                    
                    <a href="{{ $card->companies->path() }}" class="list-group-item list-group-item-action" target="_blank">{{  $card->companies->name_by_lang }}</a>
                    
                 
            </ul>
            
        </div>
    </div>
    
  
</div>