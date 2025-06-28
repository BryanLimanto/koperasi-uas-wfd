@extends('admin_page.app')

@section('content')
    <section class="h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-900">
        <div class="w-full max-w-md p-6 space-y-4 bg-white rounded-lg shadow dark:border dark:bg-gray-800 dark:border-gray-700">
            <div class="text-center">
                <a href="#" class="flex justify-center items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                    <img class="w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg" alt="logo">
                    Koperasi
                </a>
                <!-- Checkmark icon -->
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 dark:bg-green-900">
                    <svg class="h-6 w-6 text-green-600 dark:text-green-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                
                <h1 class="mt-3 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Email Verified Successfully!
                </h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                    Your account is now active. You can start using the app.
                </p>
            </div>

            <!-- Automatic redirect to dashboard -->
            <a href="{{ route('staff') }}" class="block w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Continue
            </a>

            <!-- Alternative: Auto-redirect with JavaScript -->
            <script>
                setTimeout(() => {
                    window.location.href = "{{ route('staff') }}";
                }, 3000);
            </script>
        </div>
    </section>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', async () => {
                const { data: { user }, error } = await supabase.auth.getUser();

                if (error || !user) {
                    alert('Verification failed. Please try logging in.');
                    window.location.href = '/staff';
                    return;
                }

                try {
                    const formData = {
                        supabase_id: user.id, 
                        email_verified_at: new Date(), 
                    };

                    await fetch('/register/update-staff', {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify(formData)
                    });
                    // Step 3: Redirect to dashboard after registration is complete
                    window.location.href = '/staff';
                    await supabase.auth.signOut();
                } catch (err) {
                    console.error('Error:', err);
                    alert('Something went wrong. Please try again later.');
                }
            });
        </script>
    @endpush
@endsection
