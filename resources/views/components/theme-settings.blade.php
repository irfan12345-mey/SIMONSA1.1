<div class="col-span-6 sm:col-span-4">
    <div class="flex gap-4" x-data="{
        theme: localStorage.getItem('theme') || 'light',
        setTheme(mode) {
            this.theme = mode;
            localStorage.setItem('theme', mode);
            if (mode === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        }
    }">
        <!-- Tombol Light Mode -->
        <button type="button" 
                @click="setTheme('light')"
                :class="{'ring-2 ring-indigo-500': theme === 'light'}"
                class="flex flex-col items-center justify-center p-4 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none w-24 transition-all">
            <svg class="w-6 h-6 text-gray-700 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            <span class="text-xs font-medium text-gray-900">Light</span>
        </button>

        <!-- Tombol Dark Mode -->
        <button type="button" 
                @click="setTheme('dark')"
                :class="{'ring-2 ring-indigo-500': theme === 'dark'}"
                class="flex flex-col items-center justify-center p-4 bg-gray-900 border border-gray-700 rounded-lg shadow-sm hover:bg-gray-800 focus:outline-none w-24 transition-all">
            <svg class="w-6 h-6 text-gray-100 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
            <span class="text-xs font-medium text-gray-100">Dark</span>
        </button>
    </div>
</div>