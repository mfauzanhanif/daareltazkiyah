<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Applicant;
use Illuminate\Support\Str;

final class TokenService
{
    /**
     * Generate a unique 8-character uppercase alphanumeric access token.
     */
    public function generate(int $length = 8): string
    {
        do {
            $token = Str::upper(Str::random($length));
        } while (Applicant::where('access_token', $token)->exists());

        return $token;
    }

    public static function make(): string
    {
        return (new self)->generate();
    }
}
