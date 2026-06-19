@component('mail::message')
# Nouveau message de contact

**De :** {{ $data['nom'] }}  
**Email :** {{ $data['email'] }}  
**Téléphone :** {{ $data['telephone'] }}  
**Sujet :** {{ $data['sujet'] }}

---

## Message

{{ $data['message'] }}

---

@component('mail::button', ['url' => 'mailto:' . $data['email']])
Répondre à {{ $data['nom'] }}
@endcomponent

Cordialement,  
L'équipe ASC Disso
@endcomponent