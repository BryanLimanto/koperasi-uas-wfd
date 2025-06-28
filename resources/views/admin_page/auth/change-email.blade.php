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
                    Change Email
                </h1>
            </div>
            
            <form class="space-y-4 md:space-y-6 max-w-sm mx-auto" action="#" id="change-email-form">
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Email</label>
                    <input type="email" name="email" id="email" placeholder="you@example.com"
                        class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                    <p id="email-error" class="mt-2 text-sm text-red-600 dark:text-red-500 hidden">
                        <span class="font-medium">Oops!</span> Invalid email address
                    </p>
                </div>

                <button type="submit"
                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Change Email
                </button>
            </form>           
        </div>
    </section>

    @push('scripts')
        <script type="module">
            const form = document.getElementById('change-email-form');
            const emailInput = document.getElementById('email');

            form.addEventListener('submit', async (e) => {
                e.preventDefault();

                const email = emailInput.value;
                const staffId = sessionStorage.getItem('staff_id');

                const { error } = await supabase.auth.updateUser({ 
                    email, 
                    options : {
                        emailRedirectTo : "{{ route('change-email-success') }}",
                    } 
                });

                if (error) {
                    alert('Error updating email: ' + error.message);
                } else {
                    sessionStorage.setItem('pending_change_email_staff', email);

                    try {
                        const response = await fetch('/edit/staff-email', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                email,
                                staff_id: staffId
                            })
                        });

                        if (!response.ok) {
                            const resText = await response.text();
                            console.error('Failed to post email:', resText);
                            throw new Error('Gagal menyimpan email ke server');
                        }
                    } catch (e) {
                        console.error('Error in fetch:', e);
                        alert('Terjadi kesalahan saat menyimpan email ke server lokal.');
                    }

                    window.location.href = '{{ route('change-email-verification') }}';
                }
            });
        </script>
    @endpush
@endsection