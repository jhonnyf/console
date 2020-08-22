<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover mb-0">
        <thead>
            <tr>                
                @foreach ($tableFields as $colum)
                    <th scope="col">{{$colum['name']}}</th>    
                @endforeach
                <th scope="col">Ações</th>    
            </tr>
        </thead>
        <tbody>
            @if (count($list) > 0)
                @foreach ($list as $row)
                    <tr>
                        @foreach ($tableFields as $colum)
                            <td>{{$row[$colum['name']]}}</td>                                            
                        @endforeach
                        <td>
                            <a href="{{route("{$route}.form",['id' => $row['id']])}}">
                                <i data-feather="edit-2" class="icon-sm"></i>
                            </a>
                            @if ($row['active'] == 1)
                                <a href="{{route("{$route}.active",['id' => $row['id']])}}">
                                    <i data-feather="check-circle" class="icon-sm"></i>    
                                </a>
                            @else
                                <a href="{{route("{$route}.active",['id' => $row['id']])}}">
                                    <i data-feather="circle" class="icon-sm"></i>    
                                </a>
                            @endif
                            <a href="{{route("{$route}.destroy",['id' => $row['id']])}}">
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