@component('mail::message')
# Goed nieuws!

Je bedrijf **{{ $company->company_name }}** is goedgekeurd 🎉

Je kunt nu stageplaatsen beheren via het platform.

@component('mail::button', ['url' => route('company.home')])
Ga naar dashboard
@endcomponent

Bedankt,<br>
{{ config('app.name') }}
@endcomponent
