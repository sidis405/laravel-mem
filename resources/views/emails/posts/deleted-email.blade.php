@component('mail::message')
# Hi {{ $recipient->name }}

Your post titled <strong>"{{ $title }}"</strong> was deleted by admin {{ $sender->name }}.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
