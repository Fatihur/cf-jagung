<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'admin';
    case USER = 'user';

    public function label(): string
    {
        return match($this) {
            self::ADMIN => 'Administrator',
            self::USER => 'User',
        };
    }

    public function description(): string
    {
        return match($this) {
            self::ADMIN => 'Dapat mengakses admin panel dan mengelola sistem',
            self::USER => 'Dapat melakukan diagnosis dan melihat riwayat',
        };
    }

    public function permissions(): array
    {
        return match($this) {
            self::ADMIN => [
                'access_admin_panel',
                'manage_diseases',
                'manage_symptoms',
                'manage_rules',
                'view_all_diagnoses',
                'manage_users',
            ],
            self::USER => [
                'perform_diagnosis',
                'view_own_history',
            ],
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(function ($case) {
            return [$case->value => $case->label()];
        })->toArray();
    }
}
