<x-mail::message>
# Testo Messaggio:

{{$message->content}}

<x-mail::button :url="$url">
Vedi Messaggio
</x-mail::button>

Grazie,<br>
il Team di {{ config('app.name') }}
</x-mail::message>
