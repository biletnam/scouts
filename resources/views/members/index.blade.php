@extends('layout.leiding')
@section('title', 'Ledenlijst')
@section('content')
    <main class="leden">
        @include('partial.success')
        <p class="pull-right"><a href="leiding/ledenlijst/excelify"><img src="img/excel.gif" alt="Excelify"></a></p>
        <h2>Ledenoverzicht</h2>
        @foreach ($members as $index => $tak)
            <div>
                <h3>{{ ($index !== 'jojos') ? ucfirst($index) : 'Jojo\'s' }}: {{ count($tak) }}</h3>
                <a class="pull-right print" href="leiding/ledenlijst/print_lijst?tak={{ $index }}">Print ledenlijst</a>

                @if (Auth::user()->hasPermission('account-management'))
                <a href="{{ route('ledenlijst.create', [$index]) }}" class="add"><i class="fa fa-plus"></i> Nieuw lid</a>
                @endif

                <button class="copy {{ $index }}">E-mailadressen kopiëren</button>
                <div class="email-list" id="{{ $index }}">
                    <b>Kopieer deze e-mailadressen naar het CC vak van je mail: </b><br>
                    @php
                        $email = '';
                        foreach ($tak as $member) {
                            if (strpos($email, $member->email) === FALSE) { $email.=$member->email.'; '; }
                        }
                    @endphp
                    {{ $email }}
                    <input type="hidden" value="{{ $email }}" class="addresses">
                </div>

                <table class="table table-striped leden">
                    <thead>
                    <tr>
                        <th>Voornaam</th>
                        <th>Achternaam</th>
                        <th>Geboortedatum</th>
                        <th>GSM</th>
                        <th>Jaar</th>
                        <th>E-mailadres</th>
                        @if (Auth::user()->hasPermission('account-management'))
                            <th class="betaald">Betaald</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($tak) > 0)
                        @foreach ($tak as $member)
                            <tr>
                                <td>{{ $member->firstname }}</td>
                                <td>{{ $member->name }}</td>
                                <td>{{ $member->birthdate }}</td>
                                <td>{{ $member->gsm }}</td>
                                <td class="text-center">{{ $member->year }}</td>
                                <td>
                                    {{ str_replace(';', '<br>', $member->email) }}
                                </td>
                                @if (Auth::user()->hasPermission('account-management'))
                                    <td class="paid">
                                        <i class="fa {{ ($member->paid) ? 'fa-check' : 'fa-remove' }}" data-id="{{ $member->id }}"></i>
                                    </td>
                                @endif
                                <td><a href="{{ route('ledenlijst.show', [$member]) }}"><i class="fa fa-eye"></i></a></td>
                                @if (Auth::user()->hasPermission('account-management'))
                                    <td><a href="{{ route('ledenlijst.edit', [$member]) }}"><i class="fa fa-pencil"></i></a></td>
                                    <td>
                                        <form action="{{ route('ledenlijst.destroy', ['member' => $member]) }}" class="delete" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr><td colspan="6">Er zijn geen leden in deze tak</td></tr>
                    @endif
                    </tbody>
                </table>
            </div>
        @endforeach
    <!-- <div class="copy-confirm">Gekopieerd!</div> -->
    </main>
@stop
@section('js')
    <script src="js/members.js"></script>
@stop