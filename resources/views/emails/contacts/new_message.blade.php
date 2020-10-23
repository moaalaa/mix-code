@component('mail::message')

# @lang($subject)

@lang($message)

 

@lang('notifications.thanks'),<br>
{{ getSettings()->name_by_lang }}
@endcomponent