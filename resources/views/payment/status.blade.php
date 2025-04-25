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
        <div class="max-w-md mx-auto bg-white p-6 rounded-xl shadow-md text-center space-y-4">
            <h2 class="text-2xl font-bold text-gray-800">Payment Status</h2>

            <p class="text-lg text-gray-600">{{ $message }}</p>

            <a
                href="{{ route('payment.start') }}"
                class="inline-block mt-4 px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-800 transition"
            >
                Start New Payment
            </a>
        </div>
    </main>
</body>
</html>
