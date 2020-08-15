<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover mb-0">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tipo de usuário</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @if ($list->count() > 0)
                @foreach ($list as $row)
                    <tr>
                        <td>{{$row->id}}</td>                                            
                        <td>{{$row->user_type}}</td>                                          
                        <td>
                            <a href="{{route('usersTypes.form',['id' => $row->id])}}">
                                <i data-feather="edit-2" class="icon-sm"></i>
                            </a>
                            @if ($row->active == 1)
                                <a href="{{route('usersTypes.active',['id' => $row->id])}}">
                                    <i data-feather="check-circle" class="icon-sm"></i>    
                                </a>
                            @else
                                <a href="{{route('usersTypes.active',['id' => $row->id])}}">
                                    <i data-feather="circle" class="icon-sm"></i>    
                                </a>
                            @endif
                            <a href="{{route('usersTypes.delete',['id' => $row->id])}}">
                                <i data-feather="trash-2" class="icon-sm"></i>
                            </a>
                        </td>                                            
                    </tr>
                @endforeach
            @else

            @endif
            
        </tbody>
    </table>
</div>