@extends('layouts.stage')

@section('content')
<div class="card_results_container">
    <h2>Номер карты: {{ $cardNumber }}</h2>

    <div class="subscription_status">
        @if ($hasSubscription)
            @if ($isVip)
                <h3 class="h3_green"><i class="fa fa-diamond"></i> VIP подписка активна</h3>
            @else
                <h3 class="h3_green"><i class="fa fa-address-card-o"></i> Стандартная подписка активна</h3>
            @endif
        @else
            <h3 class="card_error">Подписка не активна</h3>
        @endif
    </div>
    <div class="user_photo">
        @if ($user->photo != null)
            <img src="{{ url('storage/images/' . $user->photo) }}" alt="User photo" width="250" />
        @endif
    </div>
    <div class="user_details">
        <div class="user_details_field">
            <label>Владелец:</label>
            {{ $user->name }} {{ $user->surname }} {{ $user->lastname }}
        </div>
        <div class="user_details_field">
            <label>Марка авто:</label>
            {{ $user->car_model }}
        </div>
        <div class="user_details_field">
            <label>Номер:</label>
            {{ $user->car_lic_number }}
        </div>
        <div class="user_details_field">
            <label>VIN:</label>
            {{ $user->car_vin }}
        </div>
    </div>
</div>
@endsection
