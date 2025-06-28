@extends('user_page.app')

@section('content')
    <section class="flex items-center justify-center bg-gray-50 dark:bg-gray-900 py-12">
        <div class="w-full max-w-md p-6 space-y-4 bg-white rounded-lg shadow dark:border dark:bg-gray-800 dark:border-gray-700">
            <div class="text-center mt-5">
                <a href="#" class="flex justify-center items-center mb-4 text-2xl font-semibold text-gray-900 dark:text-white">
                    <img class="w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg" alt="logo">
                    Koperasi
                </a>
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Register New Member
                </h1>
            </div>

            <!-- Add Member Modal -->
            <form action="#" id="add-member" class="space-y-4">
                <div class="grid gap-4">
                    <!-- This section goes to users table -->
                    <div>
                    <label for="email" class="block mb-2 text-sm font-semibold text-gray-800 dark:text-gray-200">Email</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-600 focus:border-primary-600 block w-full p-3 dark:bg-gray-800 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="domain@example.com"
                        required
                    >
                    </div>
                
                    <div>
                    <label for="username" class="block mb-2 text-sm font-semibold text-gray-800 dark:text-gray-200">Username</label>
                    <input
                        type="text"
                        name="username"
                        id="username"
                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-600 focus:border-primary-600 block w-full p-3 dark:bg-gray-800 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="John Doe"
                        required
                    >
                    </div>
                    
                    <div>
                    <label for="name" class="block mb-2 text-sm font-semibold text-gray-800 dark:text-gray-200">Name</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-600 focus:border-primary-600 block w-full p-3 dark:bg-gray-800 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="John Doe"
                        required
                    >
                    </div>
                
                    <div>
                    <label for="phone" class="block mb-2 text-sm font-semibold text-gray-800 dark:text-gray-200">Phone</label>
                    <input
                        type="tel"
                        name="phone"
                        id="phone"
                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-600 focus:border-primary-600 block w-full p-3 dark:bg-gray-800 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="12345678"
                        required
                    >
                    </div>
                
                    <!-- Upload Image -->
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white" for="profile">Upload profile picture (optional)</label>
                        <input id="user-profile" class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file" accept="image/*">
                    </div>
                    
                    <!-- This section goes to history table then divide to member account table-->
                    <div>
                    <label for="deposit" class="block mb-2 text-sm font-semibold text-gray-800 dark:text-gray-200">Deposit</label>
                    <input
                        type="number"
                        name="deposit"
                        id="deposit"
                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-600 focus:border-primary-600 block w-full p-3 dark:bg-gray-800 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Rp. 100.000"
                        required
                    >
                    </div>

                    
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <div class="flex items-center gap-2">
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            style="width: 250px;" 
                            placeholder="••••••••"
                            required
                        >
                        <button type="button" id="toggle-password" aria-label="Toggle password visibility"
                            class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                            <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                        </div>
                    </div>

                    <div>
                        <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
                        <div class="flex items-center gap-2">
                        <input
                            type="password"
                            name="confirm-password"
                            id="confirm-password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            style="width: 250px;" 
                            placeholder="••••••••"
                            required
                        >
                        <button type="button" id="toggle-confirm-password" aria-label="Toggle confirm password visibility"
                            class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                            <svg id="eye-icon-confirm" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                        </div>
                    </div>
                </div>              
                <div class="grid grid-cols-2 gap-3 mt-4">
                    <button type="submit" class="w-full justify-center sm:w-auto text-gray-500 inline-flex items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Register Member</button>
                    <a href="{{ route('simpan') }}" class="w-full justify-center sm:w-auto text-gray-500 inline-flex items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                        Back to Dashboard
                    </a>
                </div>
            </form>
        </div>
    </section>

    <!-- Toogle Password Script -->
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
            const togglePasswordConfirm = document.getElementById('toggle-confirm-password');
            const passwordInputConfirm = document.getElementById('confirm-password');
            const eyeIconConfirm = document.getElementById('eye-icon-confirm');

            togglePasswordConfirm.addEventListener('click', () => {
                const type = passwordInputConfirm.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInputConfirm.setAttribute('type', type);
                eyeIconConfirm.classList.toggle('text-blue-600');
            });
        </script>

        <!-- Register Member -->
        <script>
        document.addEventListener('DOMContentLoaded', () => {
            const addMemberForm = document.getElementById('add-member');

            addMemberForm.addEventListener('submit', async (e) => {
                e.preventDefault();

                // Get form values
                const formData = {
                    username: document.getElementById('username').value,
                    name: document.getElementById('name').value,
                    email: document.getElementById('email').value,
                    phone: document.getElementById('phone').value,
                    password: document.getElementById('password').value,
                    confirmPassword: document.getElementById('confirm-password').value,
                    deposit: parseFloat(document.getElementById('deposit').value),
                    file: document.getElementById('user-profile').files[0],
                    staffId: sessionStorage.getItem('staffId')
                };

                if (formData.password !== formData.confirmPassword) {
                    ['password', 'confirm-password'].forEach(id => {
                        const el = document.getElementById(id);
                        el.classList.add('border-red-500', 'bg-red-50', 'text-red-900');
                    });
                    alert('Passwords do not match!');
                    return;
                }

                try {
                    // Step 1: Create user in Supabase
                    const { data: authData, error: authError } = await supabase.auth.signUp({
                        email: formData.email,
                        password: formData.password,
                        options: {
                            data: {
                                username: formData.username,
                                name: formData.name,
                                phone: formData.phone,
                            },
                            emailRedirectTo: `{{ route('member-verify-success') }}`
                        }
                    });

                    if (authError) throw new Error(authError.message);

                    // Step 2: Send data to Laravel backend
                    const laravelFormData = new FormData();
                    laravelFormData.append('supabase_id', authData.user.id);
                    laravelFormData.append('staff_id', formData.staffId);
                    laravelFormData.append('name', formData.name);
                    laravelFormData.append('email', formData.email);
                    laravelFormData.append('phone', formData.phone);
                    laravelFormData.append('username', formData.username);
                    laravelFormData.append('amount', formData.deposit);
                    if (formData.file) laravelFormData.append('profile', formData.file);

                    const response = await fetch('/register/new-member', {
                        method: 'POST',
                        body: laravelFormData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });

                    if (!response.ok) {
                        const errorData = await response.json();
                        throw new Error(errorData.message || 'Backend registration failed');
                    }

                    localStorage.setItem('member_pending_verification_email', email);
                    window.location.href = "{{ route('member-verify-email') }}"

                } catch (error) {
                    console.error('Registration error:', error);
                    alert(`Registration failed: ${error.message}`);
                }
            });

            function closeMemberDrawer() {
                const drawer = document.getElementById('add-member');
                drawer.classList.add('-translate-x-full');
                drawer.setAttribute('aria-hidden', 'true');
            }
        });
        </script>
@endsection