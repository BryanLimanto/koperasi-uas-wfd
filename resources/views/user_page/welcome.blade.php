@extends('user_page.app')

@section('content')
    <nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo">
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Travel App</span>
            </a>
            
            <!-- Wrap both buttons inside one flex container to avoid gap -->
            <div class="flex md:order-2 space-x-2 rtl:space-x-reverse"> 
                <a type="button" href="{{ route('member-login') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</a>
            </div>                       
        </div>        
    </nav>

     <section class="bg-white dark:bg-gray-900 mt-10">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 grid lg:grid-cols-2 gap-8 lg:gap-16">
            <div class="flex flex-col justify-center">
                <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Membangun Ekonomi Bersama yang Berkelanjutan</h1>
                <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400">Koperasi Sejahtera Bersama berkomitmen untuk memberdayakan anggotanya melalui prinsip gotong royong dan usaha kolektif. Kami menghadirkan solusi keuangan inklusif dan program pemberdayaan untuk menciptakan nilai tambah bagi seluruh anggota.</p>
                <div class="flex flex-col space-y-4 sm:flex-row sm:space-y-0">
                    <a href="{{ route('member-login') }}" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                        Gabung Sekarang
                        <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                    <a href="#" class="py-3 px-5 ms-4 text-base font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
            <div>
                <iframe class="mx-auto w-full lg:max-w-xl h-64 rounded-lg sm:h-96 shadow-xl" src="https://www.youtube.com/embed/VIDEO_KOPERASI" title="Video Profil Koperasi Sejahtera Bersama" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </section>

    <section class="bg-white dark:bg-gray-900">
        <div class="gap-16 items-center py-8 px-4 mx-auto max-w-screen-xl lg:grid lg:grid-cols-2 lg:py-16 lg:px-6">
            <div class="font-light text-gray-500 sm:text-lg dark:text-gray-400">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Kami Membangun Ekonomi Bersama</h2>
                <p class="mb-4">Koperasi Mandiri Sejahtera adalah wadah bagi anggota untuk mencapai kesejahteraan bersama. Kami mengedepankan prinsip kekeluargaan dan gotong royong dalam setiap kegiatan usaha. Dengan semangat bersama, kami menyediakan layanan simpan pinjam, usaha bersama, dan pembagian SHU yang adil.</p>
                <p>Sebagai koperasi modern, kami menggabungkan nilai-nilai tradisional dengan manajemen profesional. Keanggotaan terbuka untuk semua yang sepaham dengan prinsip koperasi, dengan sistem pengelolaan yang transparan dan akuntabel.</p>
            </div>
            <div class="grid grid-cols-2 gap-4 mt-8">
                <img class="w-full rounded-lg" src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Anggota koperasi berdiskusi">
                <img class="mt-4 w-full lg:mt-10 rounded-lg" src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Rapat tahunan koperasi">
            </div>
        </div>
    </section>

    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
            <div class="mx-auto max-w-screen-sm text-center">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold leading-tight text-gray-900 dark:text-white">Bergabunglah Menjadi Anggota Koperasi Kami</h2>
                <p class="mb-6 font-light text-gray-500 dark:text-gray-400 md:text-lg">Dapatkan manfaat keanggotaan mulai dari simpan pinjam, bagi hasil, hingga program kesejahteraan. Syarat mudah dan proses cepat.</p>
            </div>
        </div>
    </section>
@endsection