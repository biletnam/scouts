@extends('layout.leiding')
@section('title', 'Lid toevoegen')
@section('content')
    <div class="row">
        <main>
            @include('partial.errors')
            @include('partial.success')
            <h3>Voeg een lid toe bij {{ $tak }}</h3>
            <form action="{{ route('ledenlijst.store') }}" method="POST" class="edit">
                {{ csrf_field() }}
                <ul>
                    <li>
                        <label for="firstname">Voornaam</label>
                        <input id=firstname" type="text" name="firstname" value="{{ old('firstname') }}">
                    </li>
                    <li>
                        <label for="name">Achternaam</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}">
                    </li>
                    <li>
                        <label for="birthdate">Geboortedatum (DD/MM/JJJJ)</label>
                        <input id="birthdate" type="text" name="birthdate" value="{{ old('birthdate') }}">
                    </li>
                    <li>
                        <label for="address">Adres</label>
                        <input id="address" type="text" name="address" value="{{ old('address') }}">
                    </li>
                    <li>
                        <label for="zip">Postcode</label>
                        <input id="zip" type="text" name="zip" value="{{ old('zip') }}">
                    </li>
                    <li>
                        <label for="city">Plaats</label>
                        <input id="city" type="text" name="city" value="{{ old('city') }}">
                    </li>
                    <li>
                        <label for="tel">Telefoonnummer</label>
                        <input id="tel" type="text" name="tel" value="{{ old('tel') }}">
                    </li>
                    <li>
                        <label for="gsm">GSM-nummer</label>
                        <input id="gsm" type="text" name="gsm" value="{{ old('gsm') }}">
                    </li>
                    <li>
                        <label for="email">E-mailadres</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}">
                    </li>
                    <li>
                        <label>Tak: <b>{{ $tak->name }}</b></label>
                        <input type="hidden" name="tak" value="{{ $tak->id }}">
                    </li>
                    <li>
                        <label>Jaar</label>
                        @if ($tak == '' || $tak == 'leiding'))
                            <input type="number" name="year" value="{{ old('year') or 1 }}">
                        @else
                        <select name="year">
                            <option value="1" {{ (old('year') != 2 && old('year') != 3) ? 'selected' : '' }}selected>1ejaars</option>
                            @if ($tak != 'kins')
                                <option value="2" {{ (old('year') == 2) ? 'selected' : '' }}>2ejaars</option>
                                @if ($tak != 'kapoenen')
                                    <option value="3" {{ (old('year') == 3) ? 'selected' : '' }}>3ejaars</option>
                                @endif
                            @endif
                        </select>
                        @endif
                    </li>
                    <li>
                        <label for="betaald">Betaald</label>
                        <input type="checkbox" name="paid" value="1">
                    </li>
                    <li><button type="submit" name="submit" class="btn-submit">Opslaan</button><a class="cancel" href="leiding/ledenlijst">Annuleer</a></li>
                </ul>
            </form>
        </main>
    </div>
@stop