@extends('layout.leiding')
@section('title', 'Gebruikers')
@section('content')
    <main>
        <h2>Gebruikers</h2>
        @foreach ($users as $index => $type)
            @if (!$type->isEmpty())
                <h3>{{ ucfirst($index) }}</h3>
                <a href="leiding/gebruikers/edit?type=<?= $index ?>"><span class="fa fa-plus"></span> Voeg toe</a>
                <table class="table table-striped users">
                    <thead>
                    <tr>
                        <th>Voornaam</th>
                        <th>Achternaam</th>
                        <th>Gebruikersnaam</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($type as $leader)
                        <tr>
                            <td>{{ ($leader->member_id != 0) ? $leader->firstname : 'Leiding'}}</td>
                            <td>{{ ($leader->member_id != 0) ? $leader->name : 'Leiding'}}</td>
                            <td>{{ ($leader->member_id != 0) ? $leader->username : 'leiding@18bp.be'}}</td>
                            <td><a href="{{ route('ledenlijst.show', [$leader->member_id]) }}"><i class="fa fa-eye"></i></a></td>
                            <td><a href="{{ route('gebruikers.edit', [$leader]) }}"><i class="fa fa-pencil"></i></a></td>
                            <td>
                                <form action="{{ route('gebruikers.destroy', [$leader]) }}" class="delete" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        @endforeach
    </main>
@stop