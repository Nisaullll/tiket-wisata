<?php

if (! function_exists('gambar_url')) {
    /**
     * Ubah path gambar (lokal di folder public atau URL eksternal) menjadi URL lengkap.
     * Nama file yang mengandung spasi di-encode per segmen.
     */
    function gambar_url(string $path): string
    {
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        return asset(implode('/', array_map('rawurlencode', explode('/', $path))));
    }
}
