<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    
    <title>Ecommerce</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-grotesk flex flex-col relative min-h-screen">
    
    <!-- Top Banner -->
    <div class="bg-black w-full h-8 flex items center justify-center text-white text-sm font-light">
        <p class="mt-1">We have good products for you</p>
    </div>
    
    <div class="mx-20 space-y-15 flex-grow">
        <header class="flex justify-between mt-5 text-xl items-center border-b pb-6 relative z-30">
            <div class="font-bold text-4xl">
                LOGO
            </div>
            
            <div class="flex gap-x-4">
                <x-nav-link href="/" >Home</x-nav-link>
                <x-nav-link href="{{ route('page.about') }}" >About</x-nav-link>
                <x-nav-link href="{{ route('page.contact') }}" >Contact</x-nav-link>
                @guest
                    <x-nav-link href="/login" >Login</x-nav-link>                    
                @endguest
            </div>
            
            <div class="flex gap-x-6 items-center">
                
                <!-- 1. Search Bar -->
                <div class="relative w-80 group">
                    <div class="relative">
                        <input 
                            type="text" 
                            id="search-input"
                            placeholder="What are you looking for?" 
                            class="w-full border border-gray-300 rounded-lg py-2 px-4 text-sm focus:outline-none focus:border-black transition-all"
                            autocomplete="off"
                        >
                        <span class="absolute right-3 top-2.5 text-gray-400">
                             <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="currentColor"><path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>
                        </span>
                    </div>

                    <!-- Search Dropdown -->
                    <div id="search-dropdown" class="absolute top-full left-0 w-full bg-white shadow-xl rounded-lg mt-2 border border-gray-100 hidden overflow-hidden z-50">
                        <ul id="search-results-list" class="max-h-80 overflow-y-auto custom-scrollbar"></ul>
                        <div id="search-no-results" class="p-4 text-sm text-gray-500 text-center hidden">
                            No products found.
                        </div>
                    </div>
                </div>

                @auth
                    <!-- 2. Notifications Bell Area -->
                    <div class="relative">
                        <button id="notification-btn" class="relative p-2 rounded-full hover:bg-gray-100 transition focus:outline-none hover:cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor"><path d="M160-200v-80h80v-280q0-83 50-147.5T420-792v-28q0-25 17.5-42.5T480-880q25 0 42.5 17.5T540-820v28q80 20 130 84.5T720-560v280h80v80H160Zm320-300Zm0 420q-33 0-56.5-23.5T400-160h160q0 33-23.5 56.5T480-80ZM320-280h320v-280q0-66-47-113t-113-47q-66 0-113 47t-47 113v280Z"/></svg>
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <span class="absolute top-1 right-1 flex h-4 w-4 items-center justify-center rounded-full bg-red-600 text-[10px] font-bold text-white ring-2 ring-white">
                                    {{ auth()->user()->unreadNotifications->count() }}
                                </span>
                            @endif
                        </button>

                        <div id="notification-dropdown" class="absolute top-full right-0 mt-2 w-96 bg-white shadow-2xl rounded-xl border border-gray-100 hidden overflow-hidden z-50 origin-top-right transition-all">
                            <div class="px-4 py-3 border-b bg-white flex justify-between items-center">
                                <h3 class="font-bold text-gray-900">Notifications</h3>
                                @if(auth()->user()->unreadNotifications->count() > 0)
                                    <button id="mark-all-read" class="text-xs text-blue-600 font-medium hover:underline focus:outline-none">
                                        Mark all read
                                    </button>
                                @endif
                            </div>
                            <ul class="max-h-[20rem] overflow-y-auto custom-scrollbar">
                                @forelse(auth()->user()->notifications as $notification)
                                @php
                                    if($notification->read_at && $notification->read_at->lt(now()->subHour())) { continue; }
                                @endphp
                                    <li class="notification-item {{ $notification->read_at ? '' : 'unread' }} border-b last:border-0 transition duration-150 ease-in-out cursor-pointer group {{ $notification->read_at ? 'bg-gray-50' : 'bg-white border-l-4 border-black' }}">
                                        <div class="p-4 flex gap-3">
                                            <div class="mt-1 shrink-0 icon-container">
                                                @if(!$notification->read_at)
                                                    <div class="w-2 h-2 rounded-full bg-blue-600 mt-1.5"></div>
                                                @else
                                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                @endif
                                            </div>
                                            <div class="flex-1">
                                                <p class="message-text text-sm {{ $notification->read_at ? 'text-gray-500 font-normal' : 'text-gray-900 font-semibold' }}">
                                                    {{ $notification->data['data'] ?? 'System Notification' }}
                                                </p>
                                                <p class="text-xs text-gray-400 mt-1">
                                                    {{ $notification->created_at->diffForHumans() }}
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <li class="py-8 flex flex-col items-center justify-center text-gray-400">
                                        <span class="text-sm">No notifications yet</span>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>

                    <!-- 3. Sidebar Toggle -->
                    <button id="sidebar-toggle" class="cursor-pointer hover:text-gray-600 transition ml-2">
                        <svg xmlns="http://www.w3.org/2000/svg" height="28px" viewBox="0 -960 960 960" width="28px" fill="currentColor"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg>
                    </button>         
                @endauth
            </div>
        </header>

        <main>
            {{ $slot }}
        </main>
    </div>

    <!-- Footer -->
    <footer class="w-full bg-black text-white mt-20 pt-16 pb-8">
        <div class="mx-20 grid grid-cols-1 md:grid-cols-4 gap-10 border-b border-gray-800 pb-10">
            <!-- Brand Section -->
            <div class="flex flex-col gap-y-4">
                <p class="text-4xl font-bold">LOGO</p>
                <p class="text-gray-400 text-sm leading-relaxed">
                    Premium products designed for your lifestyle. Quality and customer satisfaction is our top priority.
                </p>
            </div>

            <!-- Quick Links -->
            <div class="flex flex-col gap-y-4">
                <h4 class="font-bold text-lg">Explore</h4>
                <ul class="text-gray-400 text-sm space-y-2">
                    <li><a href="/" class="hover:text-white transition">Home</a></li>
                    <li><a href="{{ route('page.about') }}" class="hover:text-white transition">About</a></li>
                    <li><a href="{{ route('AllProducts') }}" class="hover:text-white transition">All Products</a></li>
                    <li><a href="{{ route('AllCategories') }}" class="hover:text-white transition">All Categories</a></li>
                </ul>
            </div>

            <!-- Customer Care -->
            <div class="flex flex-col gap-y-4">
                <h4 class="font-bold text-lg">Support</h4>
                <ul class="text-gray-400 text-sm space-y-2">
                    <li><a href="{{ route('page.contact') }}" class="hover:text-white transition">Contact Us</a></li>
                    <li><a href="{{ route('page.shipping-policy') }}" class="hover:text-white transition">Shipping Policy</a></li>
                    <li><a href="{{ route('page.returns') }}" class="hover:text-white transition">Returns & Exchanges</a></li>
                    <li><a href="{{ route('page.faq') }}" class="hover:text-white transition">FAQ</a></li>
                </ul>
            </div>

            <!-- Newsletter / Social -->
            <div class="flex flex-col gap-y-4">
                <h4 class="font-bold text-lg">Stay Connected</h4>
                <p class="text-gray-400 text-sm">Subscribe to our newsletter for updates.</p>
                <div class="flex gap-2 mt-2">
                    <!-- Social Icons Placeholders -->
                    <a href="#" class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center hover:bg-white hover:text-black transition">
                        <span class="text-xs font-bold">FB</span>
                    </a>
                    <a href="#" class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center hover:bg-white hover:text-black transition">
                        <span class="text-xs font-bold">IG</span>
                    </a>
                    <a href="#" class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center hover:bg-white hover:text-black transition">
                        <span class="text-xs font-bold">X</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="text-center text-gray-600 text-sm mt-8">
            &copy; {{ date('Y') }} Ecommerce. All rights reserved.
        </div>
    </footer>

    @auth
    <!-- Overlay & Sidebar -->
    <div id="overlay" class="fixed inset-0 bg-black/50 z-40 hidden transition-opacity opacity-0 duration-300"></div>
    <div id="sidebar" class="fixed top-0 right-0 h-full w-80 bg-white z-50 shadow-2xl transform translate-x-full transition-transform duration-300 ease-in-out flex flex-col">
        
    <!-- 1. Header: Close Button & Title -->
    <div class="flex justify-between items-center p-5 border-b border-gray-100">
        <h2 class="text-xl font-bold text-gray-800">Account Menu</h2>
        <button id="close-sidebar" class="p-2 rounded-full hover:bg-gray-100 transition text-gray-500 hover:text-black">
            <span class="material-symbols-outlined text-2xl">close</span>
        </button>
    </div>
    
    <!-- 2. User Info Card -->
    <div class="p-6 bg-gray-50 border-b border-gray-100">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-full bg-black/75 text-white flex items-center justify-center text-2xl font-bold shadow-md">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div class="overflow-hidden">
                <p class="font-bold text-lg text-gray-900 truncate">{{ auth()->user()->name }}</p>
                <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                
                @if(!is_null(Auth::user()->balance))
                    <p class="text-xs text-gray-500 truncate">
                        Your balance is : ${{ auth()->user()->balance }}
                    </p>
                @endif

                <span class="inline-block mt-1 px-2 py-0.5 text-[10px] font-bold tracking-wide text-white bg-gray-800 rounded-full uppercase">
                    {{ auth()->user()->getRoleNames()->implode(', ') }}
                </span>
            </div>
        </div>
    </div>

    <!-- 3. Navigation Links -->
    <div class="flex-1 overflow-y-auto custom-scrollbar p-4 space-y-2">
        
        <!-- A. General -->
        <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mt-2 mb-1">
            General
        </p>

        @auth
        <a href="{{ route('cart') }}" class="flex items-center gap-3 p-3 text-gray-700 hover:bg-green-100 rounded-lg transition group">
            <span class="material-symbols-outlined text-gray-500 group-hover:text-green-700">shopping_bag</span>
            <span class="font-medium group-hover:text-green-700">Cart</span>
        </a>
        @endauth


        <!-- B. Seller & Admin -->
        @hasanyrole('seller|admin')
            <hr class="my-2 border-gray-100">
            <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mt-2 mb-1">
                Seller Zone
            </p>
            
            <a href="{{ route('SellerDashboard') }}" class="flex items-center gap-3 p-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition group">
                <span class="material-symbols-outlined text-gray-500 group-hover:text-blue-700">storefront</span>
                <span class="font-medium">Seller Dashboard</span>
            </a>

            <a href="{{ route('AddProduct.view') }}" class="flex items-center gap-3 p-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition group">
                <span class="material-symbols-outlined text-gray-500 group-hover:text-blue-700">add_box</span>
                <span class="font-medium">Add New Product</span>
            </a>
        @endhasanyrole


        <!-- C. Admin Only -->
        @role('admin')
            <hr class="my-2 border-gray-100">
            <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mt-2 mb-1">
                Admin Control
            </p>
            
            <a href="{{ route('GetCustomers') }}" class="flex items-center gap-3 p-3 text-gray-700 hover:bg-red-50 hover:text-red-700 rounded-lg transition group">
                <span class="material-symbols-outlined text-gray-500 group-hover:text-red-700">group</span>
                <span class="font-medium">Manage Users</span>
            </a>

            <a href="{{ route('GetSellers') }}" class="flex items-center gap-3 p-3 text-gray-700 hover:bg-red-50 hover:text-red-700 rounded-lg transition group">
                <span class="material-symbols-outlined text-gray-500 group-hover:text-red-700">store</span>
                <span class="font-medium">Manage Sellers</span>
            </a>
        @endrole
    </div>

    <!-- 4. Footer: Logout -->
    <div class="p-4 border-t border-gray-100 bg-gray-50">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="w-full flex items-center justify-center gap-2 p-3 text-red-600 bg-white border border-red-100 hover:bg-red-600 hover:text-white rounded-lg transition shadow-sm font-medium hover:cursor-pointer">
                <span class="material-symbols-outlined text-[20px]">logout</span>
                Sign Out
            </button>
        </form>
    </div>
</div>
    {{-- <div id="sidebar" class="fixed top-0 right-0 h-full w-80 bg-white z-50 shadow-2xl transform translate-x-full transition-transform duration-300 ease-in-out flex flex-col">
        
        <!-- 1. Header: Close Button & Title -->
        <div class="flex justify-between items-center p-5 border-b border-gray-100">
            <h2 class="text-xl font-bold text-gray-800">Account Menu</h2>
            <button id="close-sidebar" class="p-2 rounded-full hover:bg-gray-100 transition text-gray-500 hover:text-black">
                <span class="material-symbols-outlined text-2xl">close</span>
            </button>
        </div>
        
        <!-- 2. User Info Card -->
        <div class="p-6 bg-gray-50 border-b border-gray-100">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-full bg-black/75 text-white flex items-center justify-center text-2xl font-bold shadow-md">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="overflow-hidden">
                    <p class="font-bold text-lg text-gray-900 truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                    @if(!is_null(Auth::user()->balance))
                        <p class="text-xs text-gray-500 truncate">Your balance is : ${{ auth()->user()->balance }}</p>
                    @endif
                    <span class="inline-block mt-1 px-2 py-0.5 text-[10px] font-bold tracking-wide text-white bg-gray-800 rounded-full uppercase">
                        {{ auth()->user()->role }}
                    </span>
                </div>
            </div>
        </div>

        <!-- 3. Navigation Links (Scrollable Area) -->
        <div class="flex-1 overflow-y-auto custom-scrollbar p-4 space-y-2">
            
            <!-- A. Regular User Links -->
            <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mt-2 mb-1">General</p>
            
            <a href="{{ route('cart') }}" class="flex items-center gap-3 p-3 text-gray-700 hover:bg-green-100 rounded-lg transition group">
                <span class="material-symbols-outlined text-gray-500 group-hover:text-green-700">shopping_bag</span>
                <span class="font-medium group-hover:text-green-700">Cart</span>
            </a>

            <!-- B. Seller & Admin Section (AddProduct Logic) -->
            @if(auth()->user()->role == 'seller' || auth()->user()->role == 'admin')
                <hr class="my-2 border-gray-100">
                <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mt-2 mb-1">Seller Zone</p>
                
                <!-- Seller Dashboard -->
                <a href="{{ route('SellerDashboard') }}" class="flex items-center gap-3 p-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition group">
                    <span class="material-symbols-outlined text-gray-500 group-hover:text-blue-700">storefront</span>
                    <span class="font-medium">Seller Dashboard</span>
                </a>

                <!-- Add Product -->
                <a href="{{ route('AddProduct.view') }}" class="flex items-center gap-3 p-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition group">
                    <span class="material-symbols-outlined text-gray-500 group-hover:text-blue-700">add_box</span>
                    <span class="font-medium">Add New Product</span>
                </a>
            @endif

            <!-- C. Admin Only Section (IsAdmin Logic) -->
            @if(auth()->user()->role == 'admin')
                <hr class="my-2 border-gray-100">
                <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mt-2 mb-1">Admin Control</p>
                
                <!-- Manage Customers -->
                <a href="{{ route('GetCustomers') }}" class="flex items-center gap-3 p-3 text-gray-700 hover:bg-red-50 hover:text-red-700 rounded-lg transition group">
                    <span class="material-symbols-outlined text-gray-500 group-hover:text-red-700">group</span>
                    <span class="font-medium">Manage Users</span>
                </a>
            @endif
        </div>

        <!-- 4. Footer: Logout -->
        <div class="p-4 border-t border-gray-100 bg-gray-50">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                @method('DELETE') <!-- مهم جداً لأن الراوت معرف كـ delete -->
                <button type="submit" class="w-full flex items-center justify-center gap-2 p-3 text-red-600 bg-white border border-red-100 hover:bg-red-600 hover:text-white rounded-lg transition shadow-sm font-medium hover:cursor-pointer">
                    <span class="material-symbols-outlined text-[20px]">logout</span>
                    Sign Out
                </button>
            </form>
        </div>
    </div> --}}
    @endauth

    <!-- ########## Scripts ########## -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // 1. Sidebar Logic
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            const closeSidebar = document.getElementById('close-sidebar');

            function openMenu() {
                if(!sidebar) return;
                overlay.classList.remove('hidden');
                setTimeout(() => { overlay.classList.remove('opacity-0'); sidebar.classList.remove('translate-x-full'); }, 10);
            }
            
            function closeMenu() {
                if(!sidebar) return;
                sidebar.classList.add('translate-x-full');
                overlay.classList.add('opacity-0');
                setTimeout(() => { overlay.classList.add('hidden'); }, 300);
            }
            if (sidebarToggle) sidebarToggle.addEventListener('click', openMenu);
            if (closeSidebar) closeSidebar.addEventListener('click', closeMenu);
            if (overlay) overlay.addEventListener('click', closeMenu);


            // 2. Notifications Dropdown
            const notifBtn = document.getElementById('notification-btn');
            const notifDropdown = document.getElementById('notification-dropdown');

            if (notifBtn && notifDropdown) {
                notifBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    notifDropdown.classList.toggle('hidden');
                });

                document.addEventListener('click', (e) => {
                    if (!notifBtn.contains(e.target) && !notifDropdown.contains(e.target)) {
                        notifDropdown.classList.add('hidden');
                    }
                });
            }

            // 3. Search Logic
            const searchInput = document.getElementById('search-input');
            const searchDropdown = document.getElementById('search-dropdown');
            const searchResultsList = document.getElementById('search-results-list');
            const searchNoResults = document.getElementById('search-no-results');
            let debounceTimer;

            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const query = this.value.trim();
                    clearTimeout(debounceTimer);
                    if (query.length < 2) {
                        searchDropdown.classList.add('hidden');
                        return;
                    }
                    debounceTimer = setTimeout(() => {
                        performSearch(query);
                    }, 300);
                });
                
                document.addEventListener('click', (e) => {
                    if (!searchInput.contains(e.target) && !searchDropdown.contains(e.target)) {
                        searchDropdown.classList.add('hidden');
                    }
                });
            }

            // 4. Mark All Read
            const markReadBtn = document.getElementById('mark-all-read');
            const notificationBadge = document.querySelector('#notification-btn span');

            if (markReadBtn) {
                markReadBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    fetch("{{ route('MarkAsRead') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            if(notificationBadge) notificationBadge.remove();
                            markReadBtn.remove();
                            const unreadItems = document.querySelectorAll('.notification-item.unread');
                            unreadItems.forEach(item => {
                                item.classList.remove('bg-white', 'border-l-4', 'border-black', 'unread');
                                item.classList.add('bg-gray-50');
                                const text = item.querySelector('.message-text');
                                if(text) {
                                    text.classList.remove('text-gray-900', 'font-semibold');
                                    text.classList.add('text-gray-500', 'font-normal');
                                }
                                const iconContainer = item.querySelector('.icon-container');
                                if(iconContainer) {
                                    iconContainer.innerHTML = '<svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
                                }
                            });
                        }
                    })
                    .catch(error => console.error('Error:', error));
                });
            }

            function performSearch(query) {
                fetch(`/search/suggestions?query=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        searchResultsList.innerHTML = '';
                        if (data.length > 0) {
                            searchDropdown.classList.remove('hidden');
                            searchNoResults.classList.add('hidden');
                            data.forEach(product => {
                                const li = document.createElement('li');
                                li.className = "border-b last:border-0 hover:bg-gray-50 transition cursor-pointer";
                                li.innerHTML = `
                                    <a href="/product/${product.id}" class="flex items-center gap-3 p-3">
                                        <img src="${product.image_url}" alt="${product.name}" class="w-10 h-10 object-cover rounded bg-gray-200">
                                        <div>
                                            <p class="font-bold text-sm text-black">${product.name}</p>
                                            <p class="text-xs text-gray-500">$${product.price}</p>
                                        </div>
                                    </a>
                                `;
                                searchResultsList.appendChild(li);
                            });
                        } else {
                            searchDropdown.classList.remove('hidden');
                            searchNoResults.classList.remove('hidden');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
    </script>
    
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1; 
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #d1d5db; 
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #9ca3af; 
        }
    </style>
</body>
</html>