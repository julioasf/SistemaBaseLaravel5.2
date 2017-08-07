@extends('layouts.app')

@section('content')

<script>
    function confirmar(){
        var opcao = confirm("Atenção!\n\nDeseja realmente efetuar a exclusão?");
        if(opcao == false){
            return false;
        }
    }
</script>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Usuários</div>

                <div class="panel-body">
                    <a href="{{ route('adminUsersCreate') }}" class="btn btn-primary btn-primary-liqut" title="Criar">
                        <span class="glyphicon glyphicon-plus"></span> Criar
                    </a>

                    @if (!empty($data['searchTitle']))
                        <hr>
                        <a href="{{ route('adminUsers') }}" class="link-edit">Listar todos</a>
                    @endif

                    @if(Session::has('message'))
                        <hr>
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif

                    <hr>
                    <form id="users-search-form" name="users_search" class="form-horizontal" role="form" method="POST" action="{{ route('adminUsers') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('search_string') ? ' has-error' : '' }}">
                            <div class="col-md-11">
                                <input id="search-string" type="text" class="form-control" name="search_string" value="{{ old('search_string') }}" placeholder="Pesquisar">

                                @if ($errors->has('search_string'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('search_string') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary btn-primary-liqut" title="Pesquisar">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </div>
                        </div>
                    </form>
                    <hr>

                    @if (!empty($data['searchTitle']))
                       <center><strong>Pesquisa:</strong> {{ $data['searchTitle'] }}</center> <br />
                    @endif
                    <strong>Total de registros:</strong> {{ $users->total() }}.<br />
                    <strong>Exibição por pagina:</strong> até {{ $users->perPage() }}.<br /><br />

                    <table>
                        <tr>
                            <th>ID</th><th>Nome</th><th>E-mail</th><th>Ações</th>
                        </tr>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a href="{{ route('adminUsersUpdate',['id' => $user->id]) }}" class="link-edit" title="Excluir">
                                    <span class="glyphicon glyphicon-edit"></span> Editar
                                </a> |
                                <a href="{{ route('adminUsersDelete',['id' => $user->id]) }}" class="link-danger" title="Excluir" onclick="return confirmar();">
                                    <span class="glyphicon glyphicon-remove-circle"></span> Excluir
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </table>

                    <br />

                    <center>
                        @if (empty($data['searchTitle']))
                            {{ $users->links() }}
                        @else
                            {{ $users->appends(['search_string' => $data['searchTitle']])->links() }}
                        @endif
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
