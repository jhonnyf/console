<div class="col" data-parent_id="{{ $category->id }}">
    <div class="header-title mb-2">{{ $category->category }}</div>

    @if ($category->categorySecondary->count())
        @foreach ($category->categorySecondary as $item)
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <p class="mb-0">
                                <a href="javascript:;" data-id="{{ $item->id }}" data-ajax="{{ route('categories.structure') }}" class="card-link d-block">
                                    {{ $item->category }}
                                    <i data-feather="chevron-right" class="icon-dual"></i>
                                </a>
                            </p>
                        </div>
                        <div class="col text-right">
                            <a href="{{ route("categories.form", ['id' => $item->id, 'id_category' => $category->id]) }}">
                                <i data-feather="edit-2" class="icon-sm"></i>
                            </a>                            
                            <a href="{{ route("categories.active", ['id' => $item->id]) }}">
                                <i data-feather="{{ $item->active == 1 ? 'check-circle' : 'circle'}}" class="icon-sm"></i>    
                            </a>      
                            @if ($item->default == 0)
                                <a href="{{ route("categories.destroy", ['id' => $item->id]) }}">
                                    <i data-feather="trash-2" class="icon-sm"></i>
                                </a>
                            @endif                                                  
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    
    <div class="row">
        <div class="col text-center">
            <a class="btn btn-primary" href="{{ route('categories.form', ['category_id' => $category->id]) }}" >
                <i data-feather="plus" class="icon-dual"></i> adicionar
            </a>
        </div>
    </div>

</div>