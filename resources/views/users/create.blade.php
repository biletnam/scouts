@extends('layout.leiding')
@section('title', 'Gebruiker toevoegen')
@section('content')
    <main>
        <h2>Maak een gebruiker aan</h2>
        <h3>Gegevens</h3>
        <form action="{{ route('gebruikers.store') }}" method="POST" class="edit">
            {{ csrf_field() }}
            <ul>
                <li>
                    <label>Selecteer lid</label>
                    <select name="member_id" id="leader"></select>
                </li>
                <li>
                    <input type="checkbox" name="active" value="1" id="active" checked>
                    <label for="active">Actieve leiding</label>
                </li>
                <li>
                    <label>Kapoenen -of welpennaam</label>
                    <input type="text" name="nickname" value="{{ old('nickname') }}">
                </li>
                <li>
                    <input type="checkbox" name="show_nick" id="show_nick" value="1">
                    <label for="show_nick">Kapoenen -of welpennaam tonen</label>
                </li>
                <li>
                    <label>Gebruikersnaam</label>
                    <input type="email" name="username" value="{{ old('username') }}">
                </li>
                <li>
                    <label>Tak</label>
                    <select name="tak_id">
                        <option value="0">- Selecteer een tak -</option>
                        @foreach ($takken as $tak)
                            <option value="{{ $tak->id }}">{{ $tak->name }}</option>
                        @endforeach
                    </select>
                </li>
                <li>
                    <button type="submit" class="btn-submit">Opslaan</button>
                    <a class="cancel" href="{{ route('gebruikers.index') }}">Annuleer</a>
                </li>
            </ul>
        </form>
        @if (isset($leader))
            <h3>Functies</h3>
            <p class="empty">Deze leider heeft momenteel geen actieve rollen</p>
            <a href="" class="add-role"><i class="fa fa-plus"></i> functie toevoegen</a>
            <form id="add-role" action="{{ route('users.role.add') }}" method="POST">
                {{ csrf_field() }}
                <select name="role_id">
                    <option value="0">- Selecteer een functie -</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                    @endforeach
                </select>
                <input type="hidden" name="leader_id" value="{{ $leader->id }}">
                <button type="submit">Functie toevoegen</button>
            </form>
        @endif
    </main>
@stop