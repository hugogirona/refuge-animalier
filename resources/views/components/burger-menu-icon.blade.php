<button
    @click="menuOpen = !menuOpen"
    :aria-pressed="menuOpen.toString()"
    class="md:hidden group inline-flex w-12 h-12 text-grayscale-text-body hover:bg-neutral-100 bg-white text-center items-center justify-center rounded transition z-50 relative">
    <span class="sr-only">Menu</span>
    <svg class="w-6 h-6 fill-current pointer-events-none" viewBox="0 0 16 16"
         xmlns="http://www.w3.org/2000/svg">
        <rect
            class="origin-center -translate-y-[5px] transition-all duration-300 ease-[cubic-bezier(.5,.85,.25,1.1)] group-[[aria-pressed=true]]:translate-x-0 group-[[aria-pressed=true]]:translate-y-0 group-[[aria-pressed=true]]:rotate-[315deg]"
            y="7" width="16" height="2" rx="1"></rect>
        <rect
            class="origin-center transition-all duration-300 ease-[cubic-bezier(.5,.85,.25,1.8)] group-[[aria-pressed=true]]:rotate-45"
            y="7" width="16" height="2" rx="1"></rect>
        <rect
            class="origin-center translate-y-[5px] transition-all duration-300 ease-[cubic-bezier(.5,.85,.25,1.1)] group-[[aria-pressed=true]]:translate-y-0 group-[[aria-pressed=true]]:rotate-[135deg]"
            y="7" width="16" height="2" rx="1"></rect>
    </svg>
</button>
