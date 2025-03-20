<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150', 'style' => 'background-color: #009ACB;']) }} onmouseover="this.style.backgroundColor='#00C2FF'" onmouseout="this.style.backgroundColor='#009ACB'">
    {{ $slot }}
</button>
