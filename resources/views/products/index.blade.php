@include('layouts.app')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="input-group mb-3">
                <a class="btn btn-primary" href="{{route('new-products')}}">
                    Novo Produto
                </a>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                </div>
                <input type="text" id="search" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1">
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Valor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $value)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$value->name}}</td>
                        <td>R$ {{number_format($value->value, 2, ',', '.')}}</td>
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