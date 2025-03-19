@component('mail::message')
# Helaas...

Je bedrijf **{{ $company->company_name }}** is niet goedgekeurd.

---

**Reden:**

> {{ $reason }}

Als je denkt dat dit onterecht is, neem contact met ons op.

@component('mail::button', ['url' => $magicUrl])
Ga naar dashboard
@endcomponent

---

**Contactpersoon:**

@if (isset($coordinator))
- **Naam:** {{ $coordinator->user->firstname }} {{ $coordinator->user->lastname }}
- **E-mail:** [{{ $coordinator->user->email }}](mailto:{{ $coordinator->user->email }})
@else
- Geen coördinator beschikbaar.
@endif

Bedankt,<br>
{{ config('app.name') }}
@endcomponent
