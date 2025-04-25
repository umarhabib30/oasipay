<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataTrans Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <main class="w-full px-4">
        <div class="max-w-md mx-auto bg-white p-6 rounded-xl shadow-md space-y-4">
            <h2 class="text-2xl font-semibold text-center text-gray-800">Start Payment</h2>

            @if (session('error'))
                <div class="bg-red-100 text-red-700 p-3 rounded text-sm">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('payment.init') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="amount" class="block text-sm font-medium text-gray-700">Amount (CHF)</label>
                    <input type="number" id="amount" name="amount" value="10.00" step="0.01" required
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                </div>

                <div class="text-center">
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-md transition">
                        Pay Now
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>
