@extends('admin_page.app')

@section('content')
    <section class="h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-900">
        <div class="w-full max-w-md p-6 space-y-4 bg-white rounded-lg shadow dark:border dark:bg-gray-800 dark:border-gray-700">
            <div class="text-center">
                <a href="#" class="flex justify-center items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                    <img class="w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg" alt="logo">
                    Koperasi  
                </a>
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Reset Password
                </h1>
            </div>
            
            <form class="space-y-4 md:space-y-6 max-w-sm mx-auto" action="#" id="forgot-password-form">
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Password</label>
                    <div class="flex items-center relative">
                        <input type="password" name="password" id="password" placeholder="••••••••"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                        <button type="button" id="toggle-password"
                            class="ml-2 text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                            <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                    <p id="password-error" class="mt-2 text-sm text-red-600 dark:text-red-500 hidden">
                        <span class="font-medium">Oops!</span> Password doesnt match
                    </p>
                </div>

                <div>
                    <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
                    <div class="flex items-center relative">
                        <input type="password" name="confirm-password" id="confirm-password" placeholder="••••••••"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                        <button type="button" id="toggle-password"
                            class="ml-2 text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                            <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                    <p id="password-error" class="mt-2 text-sm text-red-600 dark:text-red-500 hidden">
                        <span class="font-medium">Oops!</span> Password doesnt match
                    </p>
                </div>
            
                <button type="submit"
                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Reset Password</button>
            
                <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                    Change your mind? Already remember your password?
                    <a href="{{ route('staff-login') }}"
                        class="font-medium text-blue-600 hover:underline dark:text-blue-500">Sign in</a>
                </p>
            </form>            
        </div>
    </section>

    @push('scripts')
        <script type="module">
            const form = document.getElementById('forgot-password-form');
            const passwordError = document.querySelectorAll('#password-error');

            form.addEventListener('submit', async (e) => {
                e.preventDefault();

                const password = document.getElementById('password').value;
                const confirmPassword = document.getElementById('confirm-password').value;

                // Reset error state
                passwordError.forEach(el => el.classList.add('hidden'));

                if (password !== confirmPassword) {
                    passwordError.forEach(el => el.classList.remove('hidden'));
                    return;
                }

                const { error } = await supabase.auth.updateUser({ password });

                if (error) {
                    alert('Error resetting password: ' + error.message);
                } else {
                    // ✅ Log the user out to invalidate the session
                    await supabase.auth.signOut();

                    // 🔐 Redirect to login so they must sign in again
                    window.location.href = '/staff';
                }
            });
        </script>

        <script>
            const togglePassword = document.getElementById('toggle-password');
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');

            togglePassword.addEventListener('click', () => {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                eyeIcon.classList.toggle('text-blue-600');
            });
        </script>
    @endpush
@endsection