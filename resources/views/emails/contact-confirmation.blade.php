@component('mail::message')
# Bonjour {{ $data['nom'] }} ! 👋

Nous avons bien reçu votre message et nous vous en remercions. Notre équipe va l'examiner et vous répondra dans les plus brefs délais.

---

## Résumé de votre message

**Sujet :** {{ $data['sujet'] }}  
**Téléphone :** {{ $data['telephone'] }}

**Votre message :**
> {{ $data['message'] }}

---

## En attendant...

@component('mail::panel')
📅 **Délai de réponse :** Nous répondons généralement sous 24 à 48 heures.  
📞 **Urgent ?** Appelez-nous au +221 76 616 69 56 (Lun-Sam, 8h-20h).
@endcomponent

@component('mail::button', ['url' => route('contact')])
Retourner sur notre site
@endcomponent

À très bientôt,  
**L'équipe ASC Disso** ⚽

---
*Cet email a été envoyé automatiquement, merci de ne pas y répondre. Pour nous contacter, utilisez le formulaire sur notre site.*
@endcomponent