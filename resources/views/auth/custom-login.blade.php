<div class="min-h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-900">
    <div class="w-full max-w-md p-6 bg-white rounded-md shadow-md dark:bg-gray-800">
        <h2 class="text-2xl font-bold text-center text-gray-900 dark:text-white">Custom Login</h2>

        <form method="POST" action="{{ route('filament.auth.login') }}" class="mt-6">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                <input id="email" name="email" type="email" class="block w-full mt-1 form-input" required autofocus>
            </div>

            <div class="mt-4">
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                <input id="password" name="password" type="password" class="block w-full mt-1 form-input" required>
            </div>

            <div class="mt-6">
                <button type="submit" class="block w-full px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                    Log in
                </button>
            </div>
        </form>
    </div>
</div>
