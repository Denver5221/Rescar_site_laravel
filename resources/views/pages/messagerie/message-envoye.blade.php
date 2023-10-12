<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $message->subject }}</title>
</head>
<body>
    <h1>{{ $message->subject }}</h1>

    <p><strong>De:</strong> {{ $message->expediteur }}</p>
    {{-- <p><strong>Pour:</strong> {{ $message->destinataire }}</p> --}}

    @if ($message->cc)
        <p><strong>CC:</strong> {{ $message->cc }}</p>
    @endif

    {!! $message->contenu !!}
    {{--  <p>{!! nl2br(e($message->contenu)) !!}</p>  --}}
    {{-- @php
        dd($message->fichier);
    @endphp --}}
    {{-- @if ($message->fichier)
         {{--  <p>Pièce jointe: <a href=" {{ asset('storage/' . $message->fichier) }}">{{ $message->fichier }}</a></p>  --}}
        {{-- <p>Pièce jointe: <a href="{{ Storage::url('fichiers/' . $message->fichier) }}">{{ $message->fichier }}</a></p>
    @endif --}}
            @if ($message->fichier)
            <a href="{{ asset($message->fichier) }}" class="btn btn-primary">Voir le Fichier Attaché</a>
            @endif
</html>
