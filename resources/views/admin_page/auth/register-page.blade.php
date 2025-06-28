@extends('admin_page.app')

@section('content')
    <section class="flex items-center justify-center bg-gray-50 dark:bg-gray-900 py-12">
        <div class="w-full max-w-md p-6 space-y-4 bg-white rounded-lg shadow dark:border dark:bg-gray-800 dark:border-gray-700">
            <div class="text-center">
                <a href="#" class="flex justify-center items-center mb-4 text-2xl font-semibold text-gray-900 dark:text-white">
                    <img class="w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg" alt="logo">
                    Koperasi
                </a>
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Create an account
                </h1>
            </div>

            <!-- Add id="register-form" to your form -->
            <form id="register-form" class="space-y-3">
                <!-- Email -->
                <div>
                    <label for="email" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                    <input type="email" id="email" class="w-full p-2 text-sm rounded-lg border bg-gray-50 text-gray-900 border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400" placeholder="name@company.com" required>
                </div>

                <!-- Name/Username -->
                <div>
                    <label for="username" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Your username</label>
                    <input type="text" id="username" class="w-full p-2 text-sm rounded-lg border bg-gray-50 text-gray-900 border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400" placeholder="username123" required>
                </div>

                <div>
                    <label for="name" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Your name</label>
                    <input type="text" id="name" class="w-full p-2 text-sm rounded-lg border bg-gray-50 text-gray-900 border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400" placeholder="username123" required>
                </div>

                <!-- Name/Username -->
                <div>
                    <label for="phone" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Your phone number</label>
                    <input type="phone" id="phone" class="w-full p-2 text-sm rounded-lg border bg-gray-50 text-gray-900 border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400" placeholder="username123" required>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                    <input type="password" id="password" class="w-full p-2 text-sm rounded-lg border bg-gray-50 text-gray-900 border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400" placeholder="••••••••" required>
                    <p id="password-error" class="mt-1 text-xs text-red-600 dark:text-red-500 hidden">
                        <span class="font-medium">Oops!</span> Passwords do not match.
                    </p>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="confirm-password" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
                    <input type="password" id="confirm-password" class="w-full p-2 text-sm rounded-lg border bg-gray-50 text-gray-900 border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400" placeholder="••••••••" required>
                    <p id="confirm-password-error" class="mt-1 text-xs text-red-600 dark:text-red-500 hidden">
                        <span class="font-medium">Oops!</span> Passwords do not match.
                    </p>
                </div>

                <!-- Upload Image -->
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload profile picture (optional)</label>
                    <input id="profile" class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file" accept="image/*">
                </div>

                <!-- Submit -->
                <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create an account</button>

                <!-- Login -->
                <p class="text-sm font-light text-gray-500 dark:text-gray-400 text-center">
                    Already have an account? <a href="{{ route('staff-login') }}" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Login here</a>
                </p>
            </form>
        </div>
    </section>

    <!-- Email Verification Modal -->
    <div id="email-verification-modal" class="fixed inset-0 z-50 bg-black/50 hidden items-center justify-center">
        <section class="w-full max-w-md p-6 space-y-4 bg-white rounded-lg shadow dark:border dark:bg-gray-800 dark:border-gray-700">
            <div class="text-center">
                <a href="#" class="flex justify-center items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                    <img class="w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg" alt="logo">
                    Koperasi
                </a>
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Verify Your Email Address
                </h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                    We’ve sent a verification link to your email. Didn't receive it?
                </p>
                <div id="verification-status" class="hidden mt-4 text-sm"></div>
            </div>
            <button 
                id="resend-button" 
                onclick="resendVerificationEmail()" 
                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >
                Resend Verification Email
            </button>
        </section>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const registerForm = document.getElementById('register-form');

                registerForm.addEventListener('submit', async (e) => {
                    e.preventDefault();

                    const username = document.getElementById('username').value;
                    const name = document.getElementById('name').value;
                    const email = document.getElementById('email').value;
                    const phone = document.getElementById('phone').value;
                    const password = document.getElementById('password').value;
                    const confirmPassword = document.getElementById('confirm-password').value;
                    const file = document.getElementById('profile').files[0];

                    const passwordInput = document.getElementById('password');
                    const confirmPasswordInput = document.getElementById('confirm-password');
                    const passwordError = document.getElementById('password-error');
                    const confirmPasswordError = document.getElementById('confirm-password-error');

                    // Reset styles and hide errors
                    [passwordInput, confirmPasswordInput].forEach(el => {
                        el.classList.remove('border-red-500', 'bg-red-50', 'text-red-900');
                    });
                    passwordError.classList.add('hidden');
                    confirmPasswordError.classList.add('hidden');

                    // ✅ Validate passwords match
                    if (password !== confirmPassword) {
                        [passwordInput, confirmPasswordInput].forEach(el => {
                            el.classList.add('border-red-500', 'bg-red-50', 'text-red-900');
                        });
                        passwordError.classList.remove('hidden');
                        confirmPasswordError.classList.remove('hidden');
                        return;
                    }

                    try {
                        const { data: signupData, error: signupError } = await supabase.auth.signUp({
                            email,
                            password, 
                            options : {
                                data : {
                                    username,
                                    name,
                                    phone,
                                },
                                emailRedirectTo : "{{ route('staff-verify-success') }}"
                            }
                        });

                        if (signupError) throw signupError;

                        const user = signupData?.user;
                        if (!user) throw new Error('Supabase registration failed.');

                        const formData = new FormData();
                        formData.append('supabase_id', user.id);
                        formData.append('name', name);
                        formData.append('email', email);
                        formData.append('phone', phone);
                        formData.append('username', username);
                        formData.append('profile', file || '');

                        const response = await fetch('/register/new-staff', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        });

                        if (!response.ok) {
                            const data = await response.json();
                            throw new Error(data.message || 'Failed to register user in MySQL');
                        }
                        
                        localStorage.setItem('staff_pending_verification_email', email);
                        // Optional: also pass in query string
                        window.location.href = "{{ route('staff-verify-email') }}";
                        // alert('Registration successful! Check the console for more details.');

                    } catch (error) {
                        console.error('Registration failed:', error);
                        alert(`Registration failed: ${error.message}`);
                    }
                });
            });
        </script>
    @endpush
@endsection
