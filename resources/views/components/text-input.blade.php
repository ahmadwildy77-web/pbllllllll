@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-200 bg-gray-50/50 focus:border-[#0066cc] focus:ring focus:ring-[#0066cc]/20 focus:bg-white rounded-xl shadow-sm transition-all duration-200 px-4 py-3 text-[#1d1d1f]']) !!}>
