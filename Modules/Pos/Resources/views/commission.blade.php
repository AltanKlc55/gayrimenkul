@extends('master')
@section('content')

    @include('breadcrump')

    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">
                {{ ___('Komisyon Oranları') }} - {{ $page['poss']['name'] }}
            </div>
            <div class="prism-toggle">
                <button class="btn btn-sm btn-primary-light" form="form">Kaydet<i class="ri-save-line ms-2 d-inline-block align-middle"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">

                <div class="col-xl-12">
                    <div class=" mt-2 mt-xl-0">
                        <form method="POST" id="form" action="{{ route('commission.store',$page['poss']['id'])}}">
                            @csrf
                        <div class="text-muted"  role="tabpanel">
                            <div class="table-responsive">
                                <table class="table text-nowrap table-success table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{ ___('Banka') }}</th>
                                        @foreach (range(1, 12) as $number)
                                            <th scope="col">{{ $number }}</th>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($page['cards'] as $card)
                                        <tr>
                                            <th scope="row">{{ $card->name }}</th>
                                            @foreach (range(1, 12) as $number)
                                                <td>
                                                    @php
                                                        $commission = collect($page['commission'])->first(function ($item) use ($card, $number) {
                                                            return $item['card_id'] == $card->id && $item['installment'] == $number;
                                                        });
                                                    @endphp
                                                    <input type="hidden" class="form-control" name="data[{{ $card->id }}][{{ $number }}][card_id]" value="{{ $card['id'] ?? '' }}">
                                                    <input type="hidden" class="form-control" name="data[{{ $card->id }}][{{ $number }}][installment]" value="{{ $number }}">
                                                    <input type="number" step="0.01" class="form-control" name="data[{{ $card->id }}][{{ $number }}][commission]" value="{{ $commission['commission'] ?? '' }}">
                                                    <input type="hidden" class="form-control" name="data[{{ $card->id }}][{{ $number }}][id]" value="{{ $commission['id'] ?? '' }}">
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection