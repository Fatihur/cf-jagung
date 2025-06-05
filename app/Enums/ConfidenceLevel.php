<?php

namespace App\Enums;

enum ConfidenceLevel: string
{
    case TIDAK_YAKIN = 'tidak_yakin';
    case KURANG_YAKIN = 'kurang_yakin';
    case CUKUP_YAKIN = 'cukup_yakin';
    case YAKIN = 'yakin';
    case SANGAT_YAKIN = 'sangat_yakin';

    public function label(): string
    {
        return match($this) {
            self::TIDAK_YAKIN => 'Tidak Yakin',
            self::KURANG_YAKIN => 'Kurang Yakin',
            self::CUKUP_YAKIN => 'Cukup Yakin',
            self::YAKIN => 'Yakin',
            self::SANGAT_YAKIN => 'Sangat Yakin',
        };
    }

    public function cfValue(): float
    {
        return match($this) {
            self::TIDAK_YAKIN => 0.2,
            self::KURANG_YAKIN => 0.4,
            self::CUKUP_YAKIN => 0.6,
            self::YAKIN => 0.8,
            self::SANGAT_YAKIN => 1.0,
        };
    }

    public function description(): string
    {
        return match($this) {
            self::TIDAK_YAKIN => 'Saya tidak yakin gejala ini ada (20%)',
            self::KURANG_YAKIN => 'Saya kurang yakin gejala ini ada (40%)',
            self::CUKUP_YAKIN => 'Saya cukup yakin gejala ini ada (60%)',
            self::YAKIN => 'Saya yakin gejala ini ada (80%)',
            self::SANGAT_YAKIN => 'Saya sangat yakin gejala ini ada (100%)',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::TIDAK_YAKIN => 'red',
            self::KURANG_YAKIN => 'orange',
            self::CUKUP_YAKIN => 'yellow',
            self::YAKIN => 'blue',
            self::SANGAT_YAKIN => 'green',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(function ($case) {
            return [$case->value => $case->label()];
        })->toArray();
    }

    public static function fromCfValue(float $cfValue): self
    {
        return match(true) {
            $cfValue <= 0.3 => self::TIDAK_YAKIN,
            $cfValue <= 0.5 => self::KURANG_YAKIN,
            $cfValue <= 0.7 => self::CUKUP_YAKIN,
            $cfValue <= 0.9 => self::YAKIN,
            default => self::SANGAT_YAKIN,
        };
    }
}
