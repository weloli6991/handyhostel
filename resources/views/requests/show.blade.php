@include('layouts.app')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="input-group mb-3">
                <a class="btn btn-primary" href="{{route('requests')}}">
                    Pedidos
                </a>
            </div>

            @if($data)
            <h5>Nº pedido: {{$data[0]->number_request}}</h5>
            <h5>Cliente: {{$data[0]->name}}</h5>
            <h5>Data do pedido: {{ date('d-m-Y', strtotime($data[0]->created_at)) }}</h5>
            <h5>Total: R$ {{number_format($data[0]->total, 2, ',', '.')}}</h5>
            @endif

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                </div>
                <input type="text" id="search" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1">
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Produto</th>
                        <th scope="col">Valor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $key => $value)
                    @for($i=0;$i<$products_array_count[$value->id];$i++)
                        <tr>
                            <th scope="row">{{$value->name}}</th>
                            <td>R$ {{number_format($value->value, 2, ',', '.')}}</td>
                        </tr>
                        @endfor
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>