@include('layouts.app')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Pedido') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('save-requests') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="client" class="col-md-4 col-form-label text-md-right">{{ __('Cliente') }}</label>

                            <div class="col-md-6">
                                <select id="client" class="form-control @error('client') is-invalid @enderror" name="client" value="{{ old('client') }}" placeholder="Nome do produto" required autocomplete="client">
                                    <option value="">Escolha um cliente</option>
                                    @foreach($clients as $key => $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>

                                @error('client')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="container my-4">


                        </div>

                        <div class="add-product">

                        </div>

                        <div class="form-group row">
                            <label for="product" class="col-md-4 col-form-label text-md-right">{{ __('Adicionar') }}</label>

                            <div class="col-md-6">
                                <select id="product" class="form-control @error('products') is-invalid @enderror" name="product" data-live-search="true">
                                    <option value="">Adicionar novo produto</option>
                                    @foreach($products as $key => $value)
                                    <option value="{{$value->id}}" data-value="{{$value->value}}" data-name="{{$value->name}}">{{$value->name}}</option>
                                    @endforeach
                                </select>

                                @error('products')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="total">
                        </div>

                        <div class="form-group row">
                            <label for="product" class="col-md-4 col-form-label text-md-right">{{ __('Total') }}</label>

                            <div class="col-md-6">
                                <p id="total" data-total="0" class="form-control">
                                    R$ 0,00
                                </p>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Cadastrar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.value').mask('000.000.000.000.000,00', {
            reverse: true
        });

        $('#product').change(function() {

            $('.add-product').append(
                '<div class="form-group row">' +
                '<label for="product" class="col-md-4 col-form-label text-md-right">Produto adicionado</label>' +
                '<div class="col-md-6">' +
                '<input type="button" class="form-control" value="Produto: ' + $(this).find(':selected').data('name') + ' / Valor: R$ ' + $(this).find(':selected').data('value') + '">' +
                '<input type="hidden" name="products[]" value="' + $(this).val() + '">' +
                '</div>' +
                '</div>' +
                '</div>'
            );

            $('#total').text('R$ ' + (parseFloat($('#total').data('total')) + parseFloat($(this).find(':selected').data('value'))).toLocaleString("pt-br", {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }));
            $('#total').data('total', (parseInt($('#total').data('total')) + parseInt($(this).find(':selected').data('value'))));
            $(this).val('');
        })
    });
</script>