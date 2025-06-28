@extends('admin_page.app')

@section('content')
    <section class="h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-900">
        <div class="w-full max-w-md p-6 space-y-6 bg-white rounded-lg shadow dark:border dark:bg-gray-800 dark:border-gray-700">
            <div class="text-center">
                <a href="#" class="flex justify-center items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                    <img class="w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg" alt="logo">
                    Koperasi
                </a>
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Forgot Your Password?
                </h1>
                <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">
                    Enter your email to receive a password reset link.
                </p>

                <form id="verify-form" class="space-y-4">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                        <input type="email" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="name@company.com" required>
                        <p id="email-error" class="mt-2 text-sm text-red-600 dark:text-red-500 hidden">
                            <span class="font-medium">Oops!</span> Please enter a valid email.
                        </p>
                    </div>

                    <button type="submit" 
                        class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    >
                        Send Reset Link
                    </button>
                </form>

                <div id="verification-status" class="hidden mt-4 text-sm text-green-600 dark:text-green-400"></div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script type="module">
            const form = document.getElementById('verify-form');
            const status = document.getElementById('verification-status');
            const errorMsg = document.getElementById('email-error');
        
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                const email = form.email.value.trim();
        
                // Validate email format first
                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                    errorMsg.textContent = 'Please enter a valid email address.';
                    errorMsg.classList.remove('hidden');
                    status.classList.add('hidden');
                    return;
                }
        
                try {
                    const { error } = await supabase.auth.resetPasswordForEmail(email, {
                        redirectTo: window.location.origin + '/staff/forgot-password'
                    });
        
                    if (error) {
                        throw new Error(error.message);
                    }
        
                    localStorage.setItem('passwordResetEmail', email);
                    errorMsg.classList.add('hidden');
                    status.textContent = '✅ Check your inbox for a password reset link.';
                    status.classList.remove('hidden');
        
                    setTimeout(() => {
                        window.location.href = "/staff/verify-password";
                    }, 2000);
        
                } catch (err) {
                    errorMsg.textContent = `Error: ${err.message}`;
                    errorMsg.classList.remove('hidden');
                    status.classList.add('hidden');
                }
            });
        </script>    
    @endpush
@endsection
