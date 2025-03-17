<h2>Stage afgekeurd</h2>

<p>Beste {{ $stage->company->user->firstname ?? 'bedrijf' }},</p>

<p>Helaas is je stageplaats <strong>{{ $stage->title }}</strong> afgekeurd.</p>

<p><strong>Reden:</strong> {{ $reason }}</p>

<p>Je kan de stage aanpassen en opnieuw indienen.</p>
