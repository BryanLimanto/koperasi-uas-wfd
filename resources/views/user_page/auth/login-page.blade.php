@extends('user_page.app')

@section('content')
    <section class="h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-900">
        <div class="w-full max-w-md p-6 space-y-4 bg-white rounded-lg shadow dark:border dark:bg-gray-800 dark:border-gray-700">
            <div class="text-center">
                <a href="#" class="flex justify-center items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                    <img class="w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg" alt="logo">
                    Koperasi
                </a>
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Sign in to your account
                </h1>
            </div>
            
            <form class="space-y-4 md:space-y-6 max-w-sm mx-auto" action="#" id="login-form">
                <!-- Email Field -->
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email or username</label>
                    <input type="text" name="email" id="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="name@company.com" required>
                    <p id="email-error" class="mt-2 text-sm text-red-600 dark:text-red-500 hidden">
                        <span class="font-medium">Oops!</span> Please enter a valid email or username.
                    </p>
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
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
                        <span class="font-medium">Oops!</span> Invalid password.
                    </p>
                </div>

                <div class="flex items-center justify-between">
                    <a href="{{ route('member-find-email') }}" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">Forgot password?</a>
                </div>
            
                <button type="submit"
                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Sign In</button>
            
                <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                    Don’t have an account yet?, please contact our staff
                </p>
            </form>            
        </div>
    </section>

    @push('scripts')
        <script>
            document.getElementById('login-form').addEventListener('submit', async (e) => {
                    e.preventDefault();

                    const emailInput = document.getElementById('email');
                    const passwordInput = document.getElementById('password');
                    const emailError = document.getElementById('email-error');
                    const passwordError = document.getElementById('password-error');

                    // Reset error styles
                    emailInput.classList.remove('bg-red-50', 'border-red-500', 'text-red-900');
                    emailError.classList.add('hidden');
                    passwordInput.classList.remove('bg-red-50', 'border-red-500', 'text-red-900');
                    passwordError.classList.add('hidden');

                    const loginIdentifier = emailInput.value.trim();
                    const password = passwordInput.value;

                    try {
                        // Always fetch email and role info from backend
                        const response = await fetch('/resolve-email-member', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({ identifier: loginIdentifier })
                        });

                        if (response.status === 403) {
                            alert("Akun Anda belum aktif. Silakan hubungi admin.");
                            return;
                        }

                        const data = await response.json();

                        const { email } = data;

                        const { error } = await supabase.auth.signInWithPassword({
                            email,
                            password
                        });

                        if (error) throw error;

                        window.location.href = "/member/dashboard/account";
                    } catch (error) {
                        console.error(error);

                        if (error.message.toLowerCase().includes('email') || error.message.toLowerCase().includes('username')) {
                            emailInput.classList.add('bg-red-50', 'border-red-500', 'text-red-900');
                            emailError.classList.remove('hidden');
                        } else {
                            passwordInput.classList.add('bg-red-50', 'border-red-500', 'text-red-900');
                            passwordError.classList.remove('hidden');
                        }
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

        <script>
            document.addEventListener('DOMContentLoaded', async () => {
                const { data: { user }, error } = await window.supabase.auth.getUser();

                if (user) {
                    // Already logged in, redirect to dashboard
                    window.location.href = '/member/dashboard/account';
                }
            });
        </script>
    @endpush
@endsection