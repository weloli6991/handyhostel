@include('layouts.app')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                </div>
                <input type="text" id="search" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1">
            </div>

            <div class="input-group mb-3">
                <a class="btn btn-primary" href="{{route('new-products')}}">
                    Novo Pedido
                </a>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Nº pedido</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Valor Total</th>
                        <th scope="col">Data</th>
                        <th scope="col">Ver</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $value)
                    <tr>
                        <th scope="row">{{$value->number_request}}</th>
                        <td>{{$value->name}}</td>
                        <td>R$ {{number_format($value->total, 2, ',', '.')}}</td>
                        <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                        <td><a href="{{route('show-requests', ['number_request' => $value->number_request])}}" type="button" class="btn btn-info"><i class="fas fa-eye"></i></a></td>
                    </tr>
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