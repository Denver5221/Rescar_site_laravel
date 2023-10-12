<x-mail::layout>
{{-- Header --}}
<x-slot:header>
<x-mail::header :url="config('app.url')">
{{ config('app.name') }}
</x-mail::header>
</x-slot:header>

{{-- Body --}}
{{-- Body --}}


{{-- Votre contenu personnalisé --}}
Bonjour,

Vous recevez cet e-mail car nous avons reçu une demande de réinitialisation de mot de passe pour votre compte.

Réinitialiser le mot de passe
Ce lien de réinitialisation du mot de passe expirera dans 60 minutes.

Si vous n'avez pas demandé de réinitialisation de mot de passe, vous pouvez ignorer cet e-mail.

Cordialement,
L'équipe RESCAR-AOC

{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
<x-slot:subcopy>
<x-mail::subcopy>
{{ $subcopy }}
</x-mail::subcopy>
</x-slot:subcopy>
@endisset

{{-- Footer --}}
<x-slot:footer>
<x-mail::footer>
© {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
</x-mail::footer>
</x-slot:footer>
</x-mail::layout>
