<div :class="{ 'dark text-white-dark': $store.app.semidark }">
    <nav x-data="sidebar"
        class="sidebar fixed top-0 bottom-0 z-50 h-full min-h-screen w-[260px] shadow-[5px_0_25px_0_rgba(94,92,154,0.1)] transition-all duration-300">
        <div class="h-full bg-white dark:bg-[#0e1726]">
            <div class="flex items-center justify-between px-4 py-3">
                <a href="index.html" class="main-logo flex shrink-0 items-center">
                    <img class="ml-[5px] w-8 flex-none" src="{{ asset('assets') }}/images/logo.png"
                        alt="image">
                    <span
                        class="align-middle text-2xl font-semibold ltr:ml-1.5 rtl:mr-1.5 dark:text-white-light lg:inline">StarCode
                        Kh</span>
                </a>
                <a href="javascript:;"
                    class="collapse-icon flex h-8 w-8 items-center rounded-full transition duration-300 hover:bg-gray-500/10 rtl:rotate-180 dark:text-white-light dark:hover:bg-dark-light/10"
                    @click="$store.app.toggleSidebar()">
                    <svg class="m-auto h-5 w-5" width="20" height="20" viewbox="0 0 24 24"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round"></path>
                        <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </a>
            </div>
            <ul class="perfect-scrollbar relative h-[calc(100vh-80px)] space-y-0.5 overflow-y-auto overflow-x-hidden p-4 py-0 font-semibold"
                x-data="{ activeDropdown: 'dashboard' }">
                <li class="menu nav-item">
                    <a href="/manage/admin">
                    <button type="button" class="nav-link group"
                        :class="{ 'active': activeDropdown === 'dashboard' }"
                        @click="activeDropdown === 'dashboard' ? activeDropdown = null : activeDropdown = 'dashboard'">
                        <div class="flex items-center">

                            <span
                                class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Dashboard</span>
                        </div>
                       
                    </button>
                </a>
                </li>
    

                <h2
                    class="-mx-4 mb-1 flex items-center bg-white-light/30 py-3 px-7 font-extrabold uppercase dark:bg-dark dark:bg-opacity-[0.08]">
                    <svg class="hidden h-5 w-4 flex-none" viewbox="0 0 24 24" stroke="currentColor"
                        stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span>Master Data</span>
                </h2>

                <li class="nav-item">
                    <ul>
                        <li class="nav-item">
                            <a href="/manage/route" class="group">
                                <div class="flex items-center">
                                    <svg class="shrink-0 group-hover:!text-primary" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2 7L7 2H12L17 7V12L22 17L17 22H12L7 17V12L2 7Z" fill="currentColor"></path>
                                    </svg>
                                    <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Route</span>
                                    
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/manage/transport" class="group">
                                <div class="flex items-center">
                                    <svg class="shrink-0 group-hover:!text-primary" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M19.5 3.75H4.5C3.67 3.75 3 4.42 3 5.25V17.75C3 18.58 3.67 19.25 4.5 19.25H19.5C20.33 19.25 21 18.58 21 17.75V5.25C21 4.42 20.33 3.75 19.5 3.75ZM19.5 2C21.43 2 23 3.57 23 5.5V18.5C23 20.43 21.43 22 19.5 22H4.5C2.57 22 1 20.43 1 18.5V5.5C1 3.57 2.57 2 4.5 2H19.5ZM12 17.75C10.67 17.75 9.5 16.58 9.5 15.25C9.5 13.92 10.67 12.75 12 12.75C13.33 12.75 14.5 13.92 14.5 15.25C14.5 16.58 13.33 17.75 12 17.75ZM12 14.25C11.28 14.25 10.75 14.78 10.75 15.5C10.75 16.22 11.28 16.75 12 16.75C12.72 16.75 13.25 16.22 13.25 15.5C13.25 14.78 12.72 14.25 12 14.25ZM7.5 5.75H16.5C16.78 5.75 17 5.97 17 6.25C17 6.53 16.78 6.75 16.5 6.75H7.5C7.22 6.75 7 6.53 7 6.25C7 5.97 7.22 5.75 7.5 5.75Z" fill="currentColor"></path>
                                    </svg>
                                    <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Transportasi</span>
                                    
                                    
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/manage/bank" class="group">
                                <div class="flex items-center">
                                    <svg class="shrink-0 group-hover:!text-primary" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2L2 8v12h20V8L12 2zm-1 13H7v-2h4v2zm6 0h-4v-2h4v2zm-6-4H7v-2h4v2zm6 0h-4v-2h4v2z" fill="currentColor"/>
                                    </svg>
                                    <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Bank</span>
                                    
                                </div>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="/manage/kendaraan" class="group">
                                <div class="flex items-center">
                                    <svg class="shrink-0 group-hover:!text-primary" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M3 10.5C3 9.11929 4.11929 8 5.5 8H18.5C19.8807 8 21 9.11929 21 10.5V15.5C21 16.8807 19.8807 18 18.5 18H16.5V16.5C16.5 16.2239 16.2761 16 16 16H8C7.72386 16 7.5 16.2239 7.5 16.5V18H5.5C4.11929 18 3 16.8807 3 15.5V10.5ZM5.5 10C5.22386 10 5 10.2239 5 10.5V15.5C5 15.7761 5.22386 16 5.5 16H6V14H18V16H18.5C18.7761 16 19 15.7761 19 15.5V10.5C19 10.2239 18.7761 10 18.5 10H5.5ZM7.5 13C7.22386 13 7 13.2239 7 13.5C7 13.7761 7.22386 14 7.5 14C7.77614 14 8 13.7761 8 13.5C8 13.2239 7.77614 13 7.5 13ZM16.5 13C16.2239 13 16 13.2239 16 13.5C16 13.7761 16.2239 14 16.5 14C16.7761 14 17 13.7761 17 13.5C17 13.2239 16.7761 13 16.5 13ZM9.5 4C9.5 3.72386 9.72386 3.5 10 3.5H14C14.2761 3.5 14.5 3.72386 14.5 4V5.5H9.5V4ZM3 15.5C3 16.3284 3.67157 17 4.5 17C5.32843 17 6 16.3284 6 15.5C6 14.6716 5.32843 14 4.5 14C3.67157 14 3 14.6716 3 15.5ZM18.5 17C19.3284 17 20 16.3284 20 15.5C20 14.6716 19.3284 14 18.5 14C17.6716 14 17 14.6716 17 15.5C17 16.3284 17.6716 17 18.5 17Z" fill="currentColor"/>
                                    </svg>
                                    <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Kendaraan</span>
                                    
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/manage/penumpang" class="group">
                                <div class="flex items-center">
                                    <svg class="shrink-0 group-hover:!text-primary" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2a5 5 0 0 0-5 5v1H6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h1v-2h10v2h1a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2h-1V7a5 5 0 0 0-5-5zM7 8a4 4 0 0 1 8 0v1H7V8zm9 11h-2v-2h2v2zm-8 0h-2v-2h2v2zm7-6H6v-6h10v6z" fill="currentColor"></path>
                                    </svg>
                                    <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Penumpang</span>
                                    
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/manage/tiket" class="group">
                                <div class="flex items-center">
                                    <svg class="shrink-0 group-hover:!text-primary" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 2C10.3431 2 9 3.34315 9 5V19C9 20.6569 10.3431 22 12 22C13.6569 22 15 20.6569 15 19V5C15 3.34315 13.6569 2 12 2ZM12 4C12.5523 4 13 4.44772 13 5V19C13 19.5523 12.5523 20 12 20C11.4477 20 11 19.5523 11 19V5C11 4.44772 11.4477 4 12 4ZM8 6H16V18H8V6ZM6 7H18V17H6V7Z" fill="currentColor"></path>
                                    </svg>
                                    <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Jenis Tiket</span>
                                    
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>


                <h2
                    class="-mx-4 mb-1 flex items-center bg-white-light/30 py-3 px-7 font-extrabold uppercase dark:bg-dark dark:bg-opacity-[0.08]">
                    <svg class="hidden h-5 w-4 flex-none" viewbox="0 0 24 24" stroke="currentColor"
                        stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span>User Interface</span>
                </h2>

                <li class="menu nav-item">
                    <a href="/manage/pemesanan" class="nav-link group">
                        <div class="flex items-center">
                            <svg class="shrink-0 group-hover:!text-primary" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 1C6.47715 1 2 5.47715 2 11C2 16.5229 6.47715 21 12 21C17.5229 21 22 16.5229 22 11C22 5.47715 17.5229 1 12 1ZM12 19C7.58248 19 4 15.4175 4 11C4 6.58248 7.58248 3 12 3C16.4175 3 20 6.58248 20 11C20 15.4175 16.4175 19 12 19ZM14 9.5C14 9.22386 13.7761 9 13.5 9C13.2239 9 13 9.22386 13 9.5C13 9.77614 13.2239 10 13.5 10C13.7761 10 14 9.77614 14 9.5ZM15 12.5C15 12.2239 14.7761 12 14.5 12C14.2239 12 14 12.2239 14 12.5C14 12.7761 14.2239 13 14.5 13C14.7761 13 15 12.7761 15 12.5ZM12 13.5C12.2761 13.5 12.5 13.2761 12.5 13C12.5 12.7239 12.2761 12.5 12 12.5C11.7239 12.5 11.5 12.7239 11.5 13C11.5 13.2761 11.7239 13.5 12 13.5ZM10.5 9.5C10.5 9.22386 10.2761 9 10 9C9.72386 9 9.5 9.22386 9.5 9.5C9.5 9.77614 9.72386 10 10 10C10.2761 10 10.5 9.77614 10.5 9.5ZM15 8.5C15 8.22386 14.7761 8 14.5 8C14.2239 8 14 8.22386 14 8.5C14 8.77614 14.2239 9 14.5 9C14.7761 9 15 8.77614 15 8.5Z" fill="currentColor"/>
                            </svg>
                            <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Pemesanan</span>
                            
                        </div>
                    </a>
                </li>

               
                


            </ul>
        </div>
    </nav>
</div>