@extends('user_page.app')

@section('content')
    <style>
        #sidebar-overlay {
            -webkit-backdrop-filter: blur(4px); /* For Safari */
            backdrop-filter: blur(4px);
        }
    </style>
    <header class="antialiased">
        <nav class="bg-white border-gray-200 px-4 py-2.5 dark:bg-gray-800">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <!-- Hamburger Button (Always Visible) -->
                    <button id="hamburger" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                        <i class="fas fa-bars text-xl"></i> <!-- Font Awesome hamburger icon -->
                    </button>

                    <a href="{{ route('member-profile') }}" class="flex mr-4">
                        <img src="https://flowbite.s3.amazonaws.com/logo.svg" class="mr-3 h-8" alt="FlowBite Logo" />
                        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Koperasi</span>
                    </a>
                </div>

                <div class="flex items-center">
                    <button type="button" class="flex mx-3 text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown">
                        <span class="sr-only">Open user menu</span>
                        <img class="w-8 h-8 rounded-full" src="" id="profile" alt="user photo">
                    </button>
                    <div class="hidden z-50 my-4 w-56 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown">
                        <div class="py-3 px-4">
                            <span id="email" class="block text-sm text-gray-500 truncate dark:text-gray-400">loading...</span>
                        </div>
                        <div class="py-3 px-4">
                            <span id="name" class="block text-sm text-gray-500 truncate dark:text-gray-400">loading...</span>
                        </div>
                        <div class="py-3 px-4">
                            <span id="phone" class="block text-sm text-gray-500 truncate dark:text-gray-400">loading...</span>
                        </div>
                        <ul class="py-1 text-gray-500 dark:text-gray-400" aria-labelledby="dropdown">
                            <li>
                                <a href="#" id="sign-out" class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sign out</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Sidebar Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed top-0 left-0 z-50 w-64 h-full bg-white border-r border-gray-200 transform -translate-x-full transition-transform dark:bg-gray-800 dark:border-gray-700">
        <div class="p-4 space-y-2">
            <a href="{{ route('account') }}" data-table="simpan" class="block px-4 py-2 rounded text-white hover:bg-gray-100 dark:hover:bg-gray-700">Simpan</a>
            <a href="{{ route('member-profile') }}" data-table="profile" class="block px-4 py-2 rounded  text-white hover:bg-gray-100 dark:hover:bg-gray-700">Profile</a>
        </div>
    </aside>

    <!-- Dynamic Content Container -->
    <div id="table-container" class="p-3 sm:p-5 antialiased">
        <!-- Profile -->
        <section class="py-8 bg-white md:py-16 dark:bg-gray-900 antialiased">
            <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
                <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16 items-center">
                    <!-- Image Section -->
                    <div class="shrink-0 max-w-md lg:max-w-lg mx-auto">
                        <img class="w-full rounded-full object-cover hidden dark:block" id="profile-photo" src="" alt="Profile Dark" />
                    </div>
            
                    <!-- Info Section -->
                    <div class="mt-6 sm:mt-8 lg:mt-0">
                        <h1 id="profile-name" class="text-2xl font-extrabold text-gray-900 dark:text-white mb-4">
                        Loading...
                        </h1>
            
                        <div class="mb-5 space-y-4">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
                            <span class="text-lg font-medium text-gray-500 dark:text-gray-400">Phone:</span>
                            <span id="profile-phone" class="text-lg font-semibold text-gray-900 dark:text-white">Loading...</span>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
                            <span class="text-lg font-medium text-gray-500 dark:text-gray-400">Email:</span>
                            <span id="profile-email" class="text-lg font-semibold text-gray-900 dark:text-white">Loading...</span>
                        </div>
                        </div>

                        <button type="button" data-drawer-target="edit-member" data-drawer-show="edit-member" class="mb-5 w-full justify-center sm:w-auto text-gray-500 inline-flex items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            Edit Profile
                        </button>

                        <button type="button" id="signout-btn" class="w-full justify-center sm:w-auto text-gray-500 inline-flex items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            Logout
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </div> 
    
    <!-- Edit Profile -->
    <form action="#" id="edit-member" class="fixed top-0 left-0 z-40 w-full h-screen max-w-md p-4 overflow-y-auto transition-transform -translate-x-full bg-white dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-update-product-label" aria-hidden="true">
        <h5 id="drawer-label" class="inline-flex items-center mb-4 text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">Edit Member</h5>
        <button type="button" data-drawer-dismiss="edit-member" aria-controls="edit-member" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 dark:hover:bg-gray-600 dark:hover:text-white">
            <svg aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
            <span class="sr-only">Close menu</span>
        </button>
        <div class="grid gap-3">
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="" placeholder="John Doe" required="">
            </div>
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                <button type="button" data-drawer-dismiss="edit-member" aria-controls="edit-member" class="w-full justify-center sm:w-auto text-gray-500 inline-flex items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                    Change Email
                </button>
            </div>
            <div>
                <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
                <input type="text" name="phone" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="" placeholder="12345678" required="">
            </div>
            <div>
                <span class="block mb-1 text-xs font-medium text-gray-900 dark:text-white">User Profile</span>
                <input class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="profile-input" type="file" name="profile" accept="image/*">
            </div>  
        </div>
        <div class="grid grid-cols-2 gap-3 mt-4">
            <button type="submit" class="w-full justify-center sm:w-auto text-gray-500 inline-flex items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Update</button>
            <button type="button" data-drawer-dismiss="edit-member" aria-controls="edit-member" class="w-full justify-center sm:w-auto text-gray-500 inline-flex items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                Discard
            </button>
        </div>
    </form>

    @push('scripts')
        <!-- Auth Script -->
        <script>
            document.addEventListener('DOMContentLoaded', async () => {
                const { data: { user }, error } = await window.supabase.auth.getUser();
        
                if (!user || error) {
                    // Not authenticated — redirect to welcome
                    window.location.href = '/member';
                    return;
                }
        
                // Save auth session state
                sessionStorage.setItem('loggedIn', 'true');
        
                // Prevent back button
                history.pushState(null, null, window.location.href);
                window.addEventListener('popstate', function (event) {
                    if (sessionStorage.getItem('loggedIn') === 'true') {
                        history.pushState(null, null, window.location.href);
                    }
                });

                const response = await fetch('/get-member', {
                    method : 'POST',
                    headers : {
                        'Content-Type' : 'application/json',
                        'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').content
                    },
                    body : JSON.stringify({email : user.email})
                });

                const userData = await response.json();

                document.getElementById('email').textContent = userData.email;
                document.getElementById('profile').src = userData.profile || 'https://flowbite.com/docs/images/people/profile-picture-5.jpg';
                document.getElementById('name').textContent = userData.username;
                document.getElementById('phone').textContent = userData.phone;
                document.getElementById('profile-name').textContent = userData.name;
                document.getElementById('profile-phone').textContent = userData.phone;
                document.getElementById('profile-email').textContent = userData.email;
                document.getElementById('profile-photo').src = userData.profile || 'https://flowbite.com/docs/images/people/profile-picture-5.jpg';
        
                // Sign-out handling
                const signOutLinks = [
                    document.getElementById('sign-out'),
                    document.getElementById('signout-btn')
                ];

                signOutLinks.forEach(link => {
                    if (link) {
                        link.addEventListener('click', async (event) => {
                        event.preventDefault();
                        await window.supabase.auth.signOut();
                        sessionStorage.removeItem('loggedIn'); // Clear session flag
                        window.location.href = '/member';
                    });
                }
            });
        });
        </script>

        <!-- Sidebar Script -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const links = document.querySelectorAll('[data-table]');
                const container = document.getElementById('table-container');
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebar-overlay');
                const toggleButton = document.getElementById('hamburger');

                // Toggle sidebar
                toggleButton.addEventListener('click', function () {
                    sidebar.classList.toggle('-translate-x-full');
                    overlay.classList.toggle('hidden');
                });

                // Close sidebar on overlay click
                overlay.addEventListener('click', function () {
                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.add('hidden');
                });

                // Close sidebar on Escape key press
                document.addEventListener('keydown', function (event) {
                    if (event.key === 'Escape') {
                        sidebar.classList.add('-translate-x-full');
                        overlay.classList.add('hidden');
                    }
                });
            });
        </script>

        <!-- Edit Member Profile -->
        <script>
            document.getElementById('edit-member').addEventListener('submit', async function (e) {
                e.preventDefault();

                // Get current user
                const { data: { user }, error: authError } = await supabase.auth.getUser();
                if (authError) {
                    console.error("Auth error:", authError);
                    alert("Failed to verify user. Please reload and try again.");
                    return;
                }

                // Create FormData from the form
                const formData = new FormData(this);
                formData.append('supabase_id', user.id);

                try {
                    const response = await fetch('/edit/member', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });

                    const result = await response.json();
                    if(response.ok){
                        window.location.reload();
                    }else{
                        alert("Update failed: " + (result.message || 'Unknown error'));
                    }
                } catch (err) {
                    console.error("Update error:", err);
                    alert("Error: " + err.message);
                }
            });
        </script>
    @endpush
@endsection