@component('mail::message')
# Helaas...

Je bedrijf **{{ $company->company_name }}** is niet goedgekeurd.

**Reden:**
> {{ $reason }}

Als je denkt dat dit onterecht is, neem contact met ons op.

Bedankt,<br>
{{ config('app.name') }}
@endcomponent
