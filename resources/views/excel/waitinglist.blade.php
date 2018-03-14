<html>
<body>
<table>
	<thead>
	<tr>
		<th>Voornaam</th>
		<th>Achternaam</th>
		<th>Geboortedatum</th>
		<th>E-mail</th>
		<th>Tel</th>
		<th>GSM</th>
		<th>Adres</th>
		<th>Postcode</th>
		<th>Plaats</th>
		<th>Betaald?</th>
	</tr>
	</thead>
	<tbody>
	@foreach($members as $index => $tak)
		<tr>
			<td colspan="11"><h2>{{ ($index == 'jojos') ? 'Jojo\'s' : ucfirst($index) }}</h2></td>
		</tr>
		<tr><td colspan="11"><h3>Priority</h3></td></tr>
		@foreach($tak['priority'] as $member)
			<tr>
				<td>{{ $member->firstname }}</td>
				<td>{{ $member->name }}</td>
				<td>{{ $member->birthdate }}</td>
				<td>{{ $member->email }}</td>
				<td>{{ $member->tel }}</td>
				<td>{{ $member->gsm }}</td>
				<td>{{ $member->address }}</td>
				<td>{{ $member->zip }}</td>
				<td>{{ $member->city }}</td>
				<td class="text-center">{{ $member->year }}ejaars</td>
				<td class="paid" style="color:{{ ($member->paid) ? '#00aa00' : '#ff0000' }};">
					<b>{{ ($member->paid) ? 'Ja' : 'Nee' }}</b>
				</td>
			</tr>
		@endforeach
		<tr><td></td></tr>
		<tr><td colspan="11"><h3>Regular</h3></td></tr>
		@foreach($tak['regular'] as $member)
			<tr>
				<td>{{ $member->firstname }}</td>
				<td>{{ $member->name }}</td>
				<td>{{ $member->birthdate }}</td>
				<td>{{ $member->email }}</td>
				<td>{{ $member->tel }}</td>
				<td>{{ $member->gsm }}</td>
				<td>{{ $member->address }}</td>
				<td>{{ $member->zip }}</td>
				<td>{{ $member->city }}</td>
				<td class="text-center">{{ $member->year }}ejaars</td>
				<td class="paid" style="color:{{ ($member->paid) ? '#00aa00' : '#ff0000' }};">
					<b>{{ ($member->paid) ? 'Ja' : 'Nee' }}</b>
				</td>
			</tr>
		@endforeach
		<tr><td></td></tr>
		<tr><td></td></tr>
	@endforeach
	</tbody>
</table>
</body>
</html>