@component('mail::message')
# Hi {{ $recipient->name }}

The post titled <strong>"{{ $post->title }}"</strong> was updated by {{ $roleLabel }} {{ $sender->name }}.

@component('mail::button', ['url' => route('posts.show', $post)])
View updated post
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
