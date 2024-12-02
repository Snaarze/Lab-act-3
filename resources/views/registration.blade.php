<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen w-screen bg-gray-100 flex justify-center items-center">
    <div class="bg-white shadow-lg rounded-lg p-8 w-96">
        <h2 class="text-2xl font-bold text-center mb-6">Register</h2>
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('registration.form') }}" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium">Full Name</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    class="w-full border px-4 py-2 rounded focus:ring-blue-500" 
                    value="{{ old('name') }}" 
                    required 
                    placeholder="Enter your full name"
                >
            </div>
            <div>
                <label for="email" class="block text-sm font-medium">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    class="w-full border px-4 py-2 rounded focus:ring-blue-500" 
                    value="{{ old('email') }}" 
                    required 
                    placeholder="Enter your email"
                >
            </div>
            <div>
                <label for="password" class="block text-sm font-medium">Password</label>
                <input 
                    type="password" 
                    name="password" 
                    id="password" 
                    class="w-full border px-4 py-2 rounded focus:ring-blue-500" 
                    required 
                    placeholder="Enter your password"
                >
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium">Confirm Password</label>
                <input 
                    type="password" 
                    name="password_confirmation" 
                    id="password_confirmation" 
                    class="w-full border px-4 py-2 rounded focus:ring-blue-500" 
                    required 
                    placeholder="Confirm your password"
                >
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">
                Register
            </button>
        </form>
        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">Already have an account?</p>
            <a href="{{ route('login.form') }}" class="text-blue-500 hover:text-blue-600 font-semibold">Login here</a>
        </div>
    </div>
</body>
</html>
