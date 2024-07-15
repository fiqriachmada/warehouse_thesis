<?php

namespace App\Helpers;

use Carbon\Carbon;

class Helpers
{
    public static function convertMonthsToYearsAndMonths($months)
    {
        if ($months < 0) {
            return "Invalid input";
        } elseif ($months == 0) {
            return "Free";
        }

        $years = floor($months / 12);
        $remainingMonths = $months % 12;

        if ($years > 0 && $remainingMonths > 0) {
            return "{$years} Years {$remainingMonths} Month";
        } elseif ($years > 0) {
            return "{$years} Years";
        } else {
            return "{$remainingMonths} Month";
        }
    }

    public static function calculateRemainingTime($startedAt, $endedAt)
    {
        $startedAt = Carbon::parse($startedAt);
        $endedAt = Carbon::parse($endedAt);

        // Hitung selisih antara dua tanggal
        $diff = $startedAt->diff($endedAt);

        // Ekstrak tahun, bulan, dan hari dari selisih
        $remainingYears = $diff->y;
        $remainingMonths = $diff->m;
        $remainingDays = $diff->d;

        $remainingTime = '';

        // Jika sisa waktu lebih dari 1 tahun, tampilkan dalam format tahun, bulan, hari
        if ($remainingYears > 0) {
            $remainingTime .= "$remainingYears Year" . ($remainingYears > 1 ? 's' : '') . ", ";
        }
        // Jika sisa waktu lebih dari 1 bulan, tampilkan dalam format bulan, hari
        if ($remainingMonths > 0) {
            $remainingTime .= "$remainingMonths Month" . ($remainingMonths > 1 ? 's' : '') . ", ";
        }
        // Tampilkan sisa waktu dalam hari
        $remainingTime .= "$remainingDays Day" . ($remainingDays > 1 ? 's' : '');

        // Trim trailing comma and space
        $remainingTime = rtrim($remainingTime, ', ');

        return $remainingTime;
    }


    public static function convertGramToKg($weightGram)
    {
        if ($weightGram >= 1000) {
            $weightKg = $weightGram / 1000;
            return number_format($weightKg) . ' Kg';
        } else {
            return $weightGram . ' gram';
        }
    }

    public static function convertCmToM($lengthCm)
    {
        if ($lengthCm >= 100) {
            $lengthM = $lengthCm / 100;
            return number_format($lengthM, 0) . ' m';
        } else {
            return $lengthCm . ' cm';
        }
    }

    public static function formatNumberShort($number)
    {
        if ($number >= 1000000000) {
            return round($number / 1000000000, 1) . 'B';
        }
        if ($number >= 1000000) {
            return round($number / 1000000, 1) . 'M';
        }
        if ($number >= 1000) {
            return round($number / 1000, 1) . 'K';
        }
        return (string)$number;
    }

    public static function formatRupiah($number)
    {
        if ($number >= 1000000000) {
            return 'Rp ' . number_format($number / 1000000000, 2, ',', '.') . 'B';
        }
        if ($number >= 1000000) {
            return 'Rp ' . number_format($number / 1000000, 2, ',', '.') . 'M';
        }
        if ($number >= 1000) {
            return 'Rp ' . number_format($number / 1000, 2, ',', '.') . 'K';
        }
        return 'Rp ' . number_format($number, 0, ',', '.');
    }

    public static function getFirstWord($sentence)
    {
        $words = explode(' ', trim($sentence));

        return $words[0];
    }
}