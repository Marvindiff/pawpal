@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-indigo-100 via-purple-100 to-pink-100 flex items-center justify-center p-6">

    <div class="bg-white/90 backdrop-blur-xl p-8 rounded-3xl shadow-2xl w-full max-w-md border border-white/30">

        <!-- HEADER -->
        <div class="text-center mb-6">

            <div class="text-5xl mb-3">
                💳
            </div>

            <h2 class="text-3xl font-bold text-indigo-700">
                Add Funds
            </h2>

            <p class="text-gray-500 mt-2">
                Choose your payment method and top up your wallet
            </p>

        </div>

        <!-- FORM -->
        <form method="POST"
              action="{{ route('wallet.add', auth()->id()) }}"
              class="space-y-5">

            @csrf

            <!-- PAYMENT METHOD -->
            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Payment Method
                </label>

                <select name="payment_method"
                        id="payment_method"
                        required

                        class="w-full p-4 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-400 outline-none transition">

                    <option value="">
                        Select payment method
                    </option>

                    <option value="gcash">
                        📱 GCash
                    </option>

                    <option value="maya">
                        💜 Maya
                    </option>

                    <option value="bank">
                        🏦 Bank Transfer
                    </option>

                    <option value="paypal">
                        🌐 PayPal
                    </option>

                   
                </select>

            </div>

           <!-- PAYMENT INFO -->
<div id="paymentInfo"
     class="hidden bg-indigo-50 border border-indigo-100 rounded-2xl p-4">

    <h3 class="font-bold text-indigo-700 mb-4">
        Scan QR to Pay
    </h3>

    <!-- QR IMAGE -->
    <div class="flex justify-center mb-4">

        <img id="paymentQR"
             src=""
             class="w-56 h-56 rounded-2xl shadow-lg border border-indigo-100 object-cover">

    </div>

    <!-- DETAILS -->
    <p id="paymentText"
       class="text-sm text-center text-gray-600">
    </p>

</div>

            <!-- AMOUNT -->
            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Amount
                </label>

                <div class="relative">

                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-bold">
                        ₱
                    </span>

                    <input type="number"
                           name="amount"
                           placeholder="Enter amount"
                           min="1"
                           required

                           class="w-full pl-10 p-4 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-green-400 outline-none transition">

                </div>

            </div>

            <!-- BUTTON -->
            <button
                class="w-full bg-gradient-to-r from-green-500 to-emerald-600 hover:scale-[1.02] hover:shadow-xl transition text-white py-4 rounded-2xl font-bold text-lg">

                ➕ Add Funds

            </button>

        </form>

    </div>

</div>

<script>

const paymentMethod =
    document.getElementById('payment_method');

const paymentInfo =
    document.getElementById('paymentInfo');

const paymentText =
    document.getElementById('paymentText');

const paymentQR =
    document.getElementById('paymentQR');

paymentMethod.addEventListener('change', function () {

    paymentInfo.classList.remove('hidden');

    // 📱 GCASH
    if(this.value === 'gcash'){

        paymentQR.src =
            '/images/payments/gcash.png';

        paymentText.innerHTML =
            '📱 Scan this GCash QR to pay.';

    }

    // 💜 MAYA
    else if(this.value === 'maya'){

        paymentQR.src =
            '/images/payments/maya.png';

        paymentText.innerHTML =
            '💜 Scan this Maya QR to pay.';

    }

    // 🏦 BANK
    else if(this.value === 'bank'){

        paymentQR.src =
            '/images/payments/bank.png';

        paymentText.innerHTML =
            '🏦 Scan this Bank QR to transfer payment.';

    }

    // 🌐 PAYPAL
    else if(this.value === 'paypal'){

        paymentQR.src =
            '/images/payments/paypal.png';

        paymentText.innerHTML =
            '🌐 Scan this PayPal QR to pay.';

    }

    else{

        paymentInfo.classList.add('hidden');

    }

});

</script>

@endsection