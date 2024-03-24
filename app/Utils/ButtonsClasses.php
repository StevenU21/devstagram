<?php

namespace App\Utils;

class ButtonsClasses
{
    public static function getClasses($variant)
    {
        // $classes = [
        //     'default' => 'w-full rounded-lg p-2 text-sm bg-gray-100 border border-transparent appearance-none rounded-tg placeholder-gray-400 outline-none focus:ring-transparent',
        //     'dark' => 'flex items-center py-2 px-4 rounded-lg text-sm bg-blue-600 text-white shadow-lg justify-center',
        //     'check' => '',
        //     'outline' => '',
        //     'icon' => ''
        // ];

        $classes = [
            'default' => 'flex items-center py-2 px-4 rounded-lg text-sm bg-blue-600 text-white shadow-lg justify-center cursor-pointer',
            'input-default' => 'w-full rounded-lg p-2 text-sm bg-gray-100 border border-transparent appearance-none rounded-tg placeholder-gray-400 outline-none focus:ring-transparent',
            'dark' => 'flex items-center py-2 px-4 rounded-lg text-sm bg-white text-black hover:bg-white/2 shadow-lg justify-center cursor-pointer',
            'outline' => '',
            'link' => 'hover:underline text-blue-600',
            'icon' => 'text-blue-400 transition ease-out duration-300 hover:bg-gray-50 bg-gray-100 h-8 px-2 py-2 text-center rounded-full text-gray-100 cursor-pointer'
        ];

        return $classes[$variant] ?? $classes['default'];
    }
}
