@if ($products->count() > 0)
    <table class="table mt-3">
        <thead>
            <tr>
                <th style="width: 100px">ID</th>
                <th>Titulo</th>
                <th style="width: 150px">Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->contents->first()->title }}</td>
                    <td>
                        <a href="javascript:;" class="btn-add-combo" data-url="{{ route('products.add-combo-save', ['id' => $product->id, 'combo_code' => $combo_code ]) }}"><i data-feather="plus-square"></i> adicionar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif