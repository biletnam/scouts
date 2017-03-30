@extends('layout.leiding')
@section('title', $member->firstname.' '.$member->name.' bewerken')
@section('content')
<div class="row">
    <main>
        <h3>Wijzig lid: {{ $member->firstname.' '.$member->name }}</h3>
        <form action="{{ route('ledenlijst.update', [$member]) }}" method="POST" class="edit">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <ul>
                <li>
                    <label for="firstname">Voornaam</label>
                    <input id=firstname" type="text" name="firstname" value="{{ $member->firstname }}">
                </li>
                <li>
                    <label for="name">Achternaam</label>
                    <input id="name" type="text" name="name" value="{{ $member->name }}">
                </li>
                <li>
                    <label for="birthdate">Geboortedatum (DD/MM/JJJJ)</label>
                        <input id="birthdate" type="text" name="birthdate" value="{{ $member->birthdate }}">
                </li>
                <li>
                    <label for="address">Adres</label>
                    <input id="address" type="text" name="address" value="{{ $member->address }}">
                </li>
                <li>
                    <label for="zip">Postcode</label>
                    <input id="zip" type="text" name="zip" value="{{ $member->zip }}">
                </li>
                <li>
                    <label for="city">Plaats</label>
                    <input id="city" type="text" name="city" value="{{ $member->city }}">
                </li>
                <li>
                    <label for="tel">Telefoonnummer</label>
                    <input id="tel" type="text" name="tel" value="{{ $member->tel }}">
                </li>
                <li>
                    <label for="gsm">GSM-nummer</label>
                    <input id="gsm" type="text" name="gsm" value="{{ $member->gsm }}">
                </li>
                <li>
                    <label for="email">E-mailadres</label>
                    <input id="email" type="email" name="email" value="{{ $member->email }}">
                </li>
                <li>
                    <label for="tak">Tak</label>
                    <select id="tak" name="tak">
                        <option value="Kapoenen" {{ ($member->tak == 'Kapoenen') ? 'selected="selected"' : '' }}>Kapoenen</option>
                        <option value="Welpen" {{ ($member->tak == 'Welpen') ? 'selected="selected"' : '' }}>Welpen</option>
                        <option value="Jojo's" {{ ($member->tak == 'Jojo\'s') ? 'selected="selected"' : '' }}>Jojo's</option>
                        <option value="Givers" {{ ($member->tak == 'Givers') ? 'selected="selected"' : '' }}>Givers</option>
                        <option value="Jins" {{ ($member->tak == 'Jins') ? 'selected="selected"' : '' }}>Jins</option>
                        <option value="Leiding" {{ ($member->tak == 'Leiding') ? 'selected="selected"' : '' }}>Leiding</option>
                    </select>
                </li>
                <li>
                    <label>Jaar</label>
                    @if (strpos($member->tak, 'leiding'))
                        <input type="number" name="year" value="{{ $member->year or 1 }}">
                    @else
                        <select name="year">
                            <option value="1" {{ ($member->year == 1) ? 'selected' : '' }}>1ejaars</option>
                            @if ($member->tak != 'Jins'): ?>
                                <option value="2" {{ ($member->year == 2) ? 'selected' : '' }}>2ejaars</option>
                                @if ($member->tak != 'Kapoenen'): ?>
                                    <option value="3" {{ ($member->year == 3) ? 'selected' : '' }}>3ejaars</option>
                                @endif
                            @endif
                        </select>
                    @endif
                </li>
                <li>
                    <label for="betaald">Betaald</label>
                    <input type="checkbox" name="paid" value="1" {{ ($member->paid == 1) ? 'checked' : '' }}>
                </li>
                <li><button type="submit" name="submit" class="btn-submit">Opslaan</button><a class="cancel" href="leiding/ledenlijst">Annuleer</a></li>
            </ul>
        </form>
    </main>
</div>
@stop