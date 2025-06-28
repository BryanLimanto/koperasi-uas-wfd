@extends('user_page.app')

@section('content')
    <style>
        #sidebar-overlay {
            -webkit-backdrop-filter: blur(4px); /* For Safari */
            backdrop-filter: blur(4px);
        }
    </style>
    <!-- Navbar -->
    <header class="antialiased">
        <nav class="bg-white border-gray-200 px-4 py-2.5 dark:bg-gray-800">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <button id="hamburger" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                        <i class="fas fa-bars text-xl"></i> 
                    </button>

                    <a href="{{ route('account') }}" class="flex mr-4">
                        <img src="https://flowbite.s3.amazonaws.com/logo.svg" class="mr-3 h-8" alt="FlowBite Logo" />
                        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Koperasi</span>
                    </a>
                </div>
                
                <!-- Preview Profile -->
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
        <!-- Table -->
        <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased">
            <div class="mx-auto max-w-screen-2xl px-4 lg:px-12">
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                        <div class="flex-1 flex items-center space-x-2">
                            <h5>
                                <span class="text-gray-500 dark:text-white">Account Information</span>
                            </h5>
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between mx-4 py-4 border-t dark:border-gray-700">
                        <div class="w-full md:w-1/2">
                            <form class="flex items-center">
                                <label for="simple-search" class="sr-only">Search</label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" />
                                        </svg>
                                    </div>
                                    <input type="text" id="simple-search" placeholder="Search for member" required="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                </div>
                            </form>
                        </div>
                        <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                            <button data-drawer-target="main-saving" data-drawer-show="main-saving" aria-controls="main-saving" class="w-full justify-center sm:w-auto text-gray-500 inline-flex items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                Deposit Main Saving
                            </button>
                        </div>
                        <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                            <button data-drawer-target="sibuhar-drawer" data-drawer-show="sibuhar-drawer" aria-controls="sibuhar-drawer" class="w-full justify-center sm:w-auto text-gray-500 inline-flex items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                Deposit Sibuhar
                            </button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="p-4">Actions</th>
                                    <th scope="col" class="p-4">Simpanan Pokok</th>
                                    <th scope="col" class="p-4">Simpanan Wajib</th>
                                    <th scope="col" class="p-4">Simpanan Sukarela</th>
                                    <th scope="col" class="p-4">Sibuhar</th>
                                    <th scope="col" class="p-4">Loan</th>
                                </tr>
                            </thead>
                            <tbody id="financial-data-row">
                                <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <div class="flex items-center space-x-4">
                                            <button data-id="" id="preview-btn" type="button" data-drawer-target="read-member" data-drawer-show="read-member" aria-controls="read-member" class="py-2 px-3 flex items-center text-sm font-medium text-center text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="currentColor" class="w-4 h-4 mr-2 -ml-0.5">
                                                    <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" />
                                                </svg>
                                                Preview
                                            </button>
                                        </div>
                                    </td>
                                    <td id="simpanan-pokok" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">Loading...</td>
                                    <td id="simpanan-wajib" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">Loading...</td>
                                    <td id="simpanan-sukarela" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">Loading...</td>
                                    <td id="sibuhar" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">Loading...</td>
                                    <td id="loan" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">Loading...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Saving -->
        <form action="#" id="main-saving" class="fixed top-0 left-0 z-40 w-full h-screen max-w-md p-4 overflow-y-auto transition-transform -translate-x-full bg-white dark:bg-gray-800" tabindex="-1" aria-labelledby="" aria-hidden="true">
            <h5 id="" class="inline-flex items-center mb-4 text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">Deposit Main Saving</h5>
            <button type="button" data-drawer-dismiss="main-saving" aria-controls="main-saving" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 dark:hover:bg-gray-600 dark:hover:text-white">
                <svg aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                <span class="sr-only">Close menu</span>
            </button>
            <div class="grid gap-4"> <!-- Slightly increased gap for cleaner spacing -->
                <div>
                  <label for="amount" class="block mb-2 text-sm font-semibold text-gray-800 dark:text-gray-200">Enter Amount</label>
                  <input
                    type="number"
                    name="amount"
                    id="amount-main-saving"
                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-600 focus:border-primary-600 block w-full p-3 dark:bg-gray-800 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Rp. 100.000"
                    required
                  >
                </div>
            </div>              
            <div class="grid grid-cols-2 gap-3 mt-4">
                <button type="submit" class="w-full justify-center sm:w-auto text-gray-500 inline-flex items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Deposit</button>
                <button type="button" data-drawer-dismiss="main-saving" aria-controls="main-saving" class="w-full justify-center sm:w-auto text-gray-500 inline-flex items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                    Cancel
                </button>
            </div>
        </form>

        <!-- Sibuhar -->
        <form action="#" id="sibuhar-drawer" class="fixed top-0 left-0 z-40 w-full h-screen max-w-md p-4 overflow-y-auto transition-transform -translate-x-full bg-white dark:bg-gray-800" tabindex="-1" aria-labelledby="" aria-hidden="true">
            <h5 id="" class="inline-flex items-center mb-4 text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">Deposit Sibuhar</h5>
            <button type="button" data-drawer-dismiss="sibuhar-drawer" aria-controls="sibuhar-drawer" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 dark:hover:bg-gray-600 dark:hover:text-white">
                <svg aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                <span class="sr-only">Close menu</span>
            </button>
            <div class="grid gap-4"> <!-- Slightly increased gap for cleaner spacing -->
                <div>
                  <label for="amount" class="block mb-2 text-sm font-semibold text-gray-800 dark:text-gray-200">Enter Amount</label>
                  <input
                    type="number"
                    name="amount"
                    id="amount-sibuhar"
                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-600 focus:border-primary-600 block w-full p-3 dark:bg-gray-800 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Rp. 100.000"
                    required
                  >
                </div>
            </div>              
            <div class="grid grid-cols-2 gap-3 mt-4">
                <button type="submit" class="w-full justify-center sm:w-auto text-gray-500 inline-flex items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Deposit</button>
                <button type="button" data-drawer-dismiss="sibuhar-drawer" aria-controls="sibuhar-drawer" class="w-full justify-center sm:w-auto text-gray-500 inline-flex items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                    Cancel
                </button>
            </div>
        </form>
        
        <!-- Preview Member Modal -->
        <div id="read-member" class="overflow-y-auto fixed top-0 left-0 z-40 p-4 w-full max-w-lg h-screen bg-white transition-transform -translate-x-full dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true">
            <div>
                <h4 id="read-drawer-label" class="mb-5 leading-none text-xl font-semibold text-gray-900 dark:text-white">Account Information</h4>
            </div>
            <button type="button" data-drawer-dismiss="read-member" aria-controls="read-member" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
                <span class="sr-only">Close menu</span>
            </button>
            <dl class="grid grid-cols-2 gap-4 mb-4">
                <div class="p-3 bg-gray-100 rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600">
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Simpanan Pokok</dt>
                    <dd id="preview-simpanan-pokok" class="flex items-center text-gray-500 dark:text-gray-400">
                        Loading...
                    </dd>
                </div>
                <div class="p-3 bg-gray-100 rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600">
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Simpanan Wajib</dt>
                    <dd id="preview-simpanan-wajib" class="text-gray-500 dark:text-gray-400">Loading...</dd>
                </div>
                <div class="p-3 bg-gray-100 rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600">
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Simpanan Sukarela</dt>
                    <dd id="preview-simpanan-sukarela" class="text-gray-500 dark:text-gray-400">Loading...</dd>
                </div>
                <div class="p-3 bg-gray-100 rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600">
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Sibuhar</dt>
                    <dd id="preview-sibuhar" class="text-gray-500 dark:text-gray-400">Loading...</dd>
                </div>
                <div class="p-3 bg-gray-100 rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600">
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Loan</dt>
                    <dd id="preview-loan" class="text-gray-500 dark:text-gray-400">Loading...</dd>
                </div>
            </dl>
            <div class="flex bottom-0 left-0 justify-center pb-4 space-x-4 w-full">
                <button type="button" data-drawer-dismiss="read-member" aria-controls="read-member" class="w-full justify-center sm:w-auto text-gray-500 inline-flex items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                    Back
                </button>
            </div>
        </div>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
    </div>

    @push('scripts')
        <!-- Auth Script -->
        <script>
            document.addEventListener('DOMContentLoaded', async () => {
                const { data: { user }, error } = await window.supabase.auth.getUser();

                if (!user || error) {
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

                try {
                    const response = await fetch('/get-member', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ email: user.email })
                    });

                    if (!response.ok) {
                        throw new Error('Failed to fetch member data');
                    }

                    const userData = await response.json();

                    // Update profile information
                    document.getElementById('email').textContent = userData.email;
                    document.getElementById('profile').src = userData.profile || 'https://flowbite.com/docs/images/people/profile-picture-5.jpg';
                    document.getElementById('name').textContent = userData.username;
                    document.getElementById('phone').textContent = userData.phone;

                    // Update preview button with user ID
                    const previewButton = document.getElementById('preview-btn');
                    if (previewButton) {
                        previewButton.setAttribute('data-id', userData.supabase_id);
                        
                        // Add click handler to show drawer
                        previewButton.addEventListener('click', () => {
                            updatePreviewDrawer(userData);
                        });
                    }

                    // Update financial data if available
                    if (userData.account) {
                        // Update table data
                        document.getElementById('simpanan-pokok').textContent = formatCurrency(userData.account.simpanan_pokok);
                        document.getElementById('simpanan-wajib').textContent = formatCurrency(userData.account.simpanan_wajib);
                        document.getElementById('simpanan-sukarela').textContent = formatCurrency(userData.account.simpanan_sukarela);
                        document.getElementById('sibuhar').textContent = formatCurrency(userData.account.sibuhar);
                        document.getElementById('loan').textContent = formatCurrency(userData.account.loan);

                        // Update preview drawer data
                        updatePreviewDrawer(userData);
                    } else {
                        // Handle case where account data doesn't exist
                        document.getElementById('financial-data-row').innerHTML = `
                            <tr>
                                <td colspan="6" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">
                                    No financial data available
                                </td>
                            </tr>
                        `;
                    }
                } catch (error) {
                    console.error('Error:', error);
                    document.getElementById('financial-data-row').innerHTML = `
                        <tr>
                            <td colspan="6" class="px-4 py-3 text-center text-red-500 dark:text-red-400">
                                Error loading financial data
                            </td>
                        </tr>
                    `;
                }

                // Sign-out handling
                const signOut = document.getElementById('sign-out');
                if (signOut) {
                    signOut.addEventListener('click', async (event) => {
                        event.preventDefault();
                        await window.supabase.auth.signOut();
                        sessionStorage.removeItem('loggedIn');
                        window.location.href = '/member';
                    });
                }
            });

            // Function to update preview drawer with financial data
            function updatePreviewDrawer(userData) {
                if (userData.account) {
                    document.getElementById('preview-simpanan-pokok').textContent = formatCurrency(userData.account.simpanan_pokok);
                    document.getElementById('preview-simpanan-wajib').textContent = formatCurrency(userData.account.simpanan_wajib);
                    document.getElementById('preview-simpanan-sukarela').textContent = formatCurrency(userData.account.simpanan_sukarela);
                    document.getElementById('preview-sibuhar').textContent = formatCurrency(userData.account.sibuhar);
                    document.getElementById('preview-loan').textContent = formatCurrency(userData.account.loan);
                }
            }

            // Helper function to format currency
            function formatCurrency(amount) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 2
                }).format(amount);
            }
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
            (async () => {
                const { data: { user }, error } = await window.supabase.auth.getUser();
                const memberId = user.id;

                async function postToRoute(route, amount) {
                    try {
                        const response = await fetch(route, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                staff_id: null,
                                member_id: memberId,
                                amount: amount
                            })
                        });

                        const data = await response.json();
                        if (response.ok) {
                            location.reload();
                        } else {
                            alert('Gagal: ' + data.message);
                            console.error(data);
                        }
                    } catch (error) {
                        console.error('Fetch error:', error);
                        alert('Terjadi kesalahan saat mengirim data.');
                    }
                }

                document.getElementById('main-saving')?.addEventListener('submit', (e) => {
                    e.preventDefault();
                    const amount = parseFloat(document.getElementById('amount-main-saving').value);
                    postToRoute('/member/deposit-simpanan', amount);
                });

                document.getElementById('sibuhar-drawer')?.addEventListener('submit', (e) => {
                    e.preventDefault();
                    const amount = parseFloat(document.getElementById('amount-sibuhar').value);
                    postToRoute('/member/deposit-sibuhar', amount);
                });
            })();
        </script>
    @endpush
@endsection