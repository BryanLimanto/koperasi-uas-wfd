@extends('admin_page.app')

@section('content')
    <section class="h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-900">
        <div class="w-full max-w-md p-6 space-y-4 bg-white rounded-lg shadow dark:border dark:bg-gray-800 dark:border-gray-700">
            <div class="text-center">
                <a href="#" class="flex justify-center items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                    <img class="w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg" alt="logo">
                    Travel App
                </a>
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Verify Your Email Address
                </h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                    We've sent a verification link to your email. Didn't receive it?
                </p>

                <div id="verification-status" class="hidden mt-4 text-sm"></div>
            </div>
            <div class="flex space-x-4">
                <button 
                    id="resend-button" 
                    onclick="resendVerificationEmail()" 
                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                >
                    Resend Verification Email
                </button>
                <a href="{{ route('simpan') }}" class="w-full text-center text-gray-900 bg-gray-100 hover:bg-gray-200 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-600 dark:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                    Back to Dashboard
                </a>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            async function resendVerificationEmail() {
            const statusEl = document.getElementById('verification-status');
            const resendBtn = document.getElementById('resend-button');

            // UI Handling
            resendBtn.disabled = true;
            resendBtn.classList.add('opacity-50', 'cursor-not-allowed');
            setTimeout(() => {
                resendBtn.disabled = false;
                resendBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            }, 60000);

            try {
                // First, try to get email from localStorage
                let email = localStorage.getItem('member_pending_verification_email');

                if (!email) {
                    statusEl.textContent = 'Email not found. Please register again.';
                    statusEl.className = 'text-red-600 dark:text-red-400';
                    statusEl.classList.remove('hidden');
                    return;
                }

                // Use signUp to resend verification email
                const { error } = await supabase.auth.resend({
                    type: 'signup',
                    email,
                    options: {
                        options: {
                            emailRedirectTo: "{{ route('member-verify-success') }}"
                        }
                    }
                });

                if (error) throw error;

                statusEl.textContent = `Verification email sent to ${email}`;
                statusEl.className = 'text-green-600 dark:text-green-400';
                localStorage.removeItem('member_pending_verification_email');
            } catch (error) {
                console.error('Resend error:', error);
                statusEl.textContent = error.message || 'Failed to resend verification email';
                statusEl.className = 'text-red-600 dark:text-red-400';
            } finally {
                statusEl.classList.remove('hidden');
            }
        }
        </script>
    @endpush
@endsection
