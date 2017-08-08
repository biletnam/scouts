@extends('layout.leiding')
@section('title', 'Wachtlijst')
@section('content')
    <main class="leden">
        <p class="pull-right"><a href="{{ route('wachtlijst.excelify') }}"><img src="img/excel.gif" alt="Excelify"></a></p>
        <h2>Wachtlijst</h2>
        <form action="{{ route('wachtlijst.register') }}" method="POST">
            @foreach ($waitinglist as $index => $tak)
                <div>
                    <h3>{{ ($index !== 'jojos') ? ucfirst($index) : 'Jojo\'s' }}: {{ count($tak['priority']) + count($tak['regular']) }}</h3>
                    <a class="pull-right print" href="leiding/wachtlijst/print_lijst?tak=<?= $index ?>">Print wachtlijst</a>
                    <div class="priority">
                        <h4>Broertjes en zusjes: {{ count($tak['priority']) }}</h4>
                        <a href="{{ route('wachtlijst.create', ['tak' => $index, 'p' => 1]) }}" class="add">
                            <i class="fa fa-plus"></i> Nieuw broertje/zusje
                        </a>

                        <button class="{{ $index }}">E-mailadressen kopiëren</button>
                        <div class="email-list" id="{{ $index }}>">
                            <b>Kopieer deze e-mailadressen naar het CC vak van je mail: </b><br>
                            @php
                                $email = '';
                                foreach ($tak['priority'] as $kid) {
                                    if (strpos($email, $kid->email) === FALSE) { $email.=$kid->email; }
                                }
                            @endphp
                            <input type="hidden" value="{{ $email }}" class="emails">
                        </div>

                        <table class="table table-striped leden">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Voornaam</th>
                                    <th>Achternaam</th>
                                    <th>Geboortedatum</th>
                                    <th>GSM</th>
                                    <th>E-mailadres</th>
                                    <th>Jaar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($tak['priority']) > 0)
                                    @foreach ($tak['priority'] as $kid)
                                        <tr>
                                            <td><input type="checkbox" name="select[]" value="{{ $kid->id }}"></td>
                                            <td>{{ $kid->firstname }}</td>
                                            <td>{{ $kid->name }}</td>
                                            <td>{{ $kid->birthdate }}</td>
                                            <td>{{ $kid->gsm }}</td>
                                            <td>
                                                {{ str_replace(';', '<br>', $kid->email) }}
                                            </td>
                                            <td class="text-center">{{ $kid->year }}</td>
                                            <td><a href="{{ route('wachtlijst.show', ['waitinglist' => $kid]) }}"><i class="fa fa-eye"></i></a></td>
                                            @if (Auth::user()->hasPermission('administratie'))
                                                <td><a href="{{ route('wachtlijst.edit', ['waitinglist' => $kid]) }}"><i class="fa fa-pencil"></i></a></td>
                                                <td><a href="{{ route('wachtlijst.destroy', ['waitinglist' => $kid]) }}"><i class="fa fa-trash"></i></a></td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td colspan="7" class="text-center">Er zijn geen wachtende broertjes/zusjes voor deze tak</td></tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="regular">
                        <h4>Nieuwe kinderen: {{ count($tak['regular']) }}</h4>
                        <a href="{{ route('wachtlijst.create', ['tak' => $index]) }}" class="add"><i class="fa fa-plus"></i> Nieuw kind</a>

                        <button class="{{ $index }}">E-mailadressen kopiëren</button>
                        <div class="email-list" id="{{ $index }}">
                            <b>Kopieer deze e-mailadressen naar het CC vak van je mail: </b><br>
                            @php
                                $email = '';
                                foreach ($tak['regular'] as $kid) {
                                    if (strpos($email, $kid->email) === FALSE) { $email.=$kid->email; }
                                }
                            @endphp
                            <input type="hidden" value="{{ $email }}" class="emails">
                        </div>

                        <table class="table table-striped leden">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Voornaam</th>
                                    <th>Achternaam</th>
                                    <th>Geboortedatum</th>
                                    <th>GSM</th>
                                    <th>E-mailadres</th>
                                    <th>Jaar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($tak['regular']) > 0)
                                    @foreach ($tak['regular'] as $kid)
                                        <tr>
                                            <td><input class="select" type="checkbox" name="select[]" value="{{ $kid->id }}"></td>
                                            <td>{{ $kid->firstname }}</td>
                                            <td>{{ $kid->name }}</td>
                                            <td>{{ $kid->birthdate }}</td>
                                            <td>{{ $kid->gsm }}</td>
                                            <td>
                                                {{ str_replace(';', '<br>', $kid->email) }}
                                            </td>
                                            <td class="text-center">{{ $kid->year }}</td>
                                            <td><a href="leiding/wachtlijst/details/<?= $kid->id ?>"><i class="fa fa-eye"></i></a></td>
                                            @if (Auth::user()->hasPermission('administratie')): ?>
                                                <td><a href="{{ route('wachtlijst.edit', ['waitinglist' => $kid]) }}"><i class="fa fa-pencil"></i></a></td>
                                                <td><a href="{{ route('wachtlijst.destroy', ['waitinglist' => $kid]) }}"><i class="fa fa-trash"></i></a></td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td colspan="7" class="text-center">Er zijn geen wachtende kinderen voor deze tak</td></tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
            Geselecteerde kinderen
            <select id="action" name="action" disabled>
                <option value="" selected>- Kies een actie -</option>
                <option value="register">inschrijven</option>
                <option value="delete">verwijderen</option>
            </select>
        </form>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="js/members.js"></script>
@stop