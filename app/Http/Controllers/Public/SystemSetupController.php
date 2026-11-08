<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

final class SystemSetupController extends Controller
{
    public function handle(Request $request): JsonResponse
    {
        $setupToken = config('app.setup_token') ?? 'daareltazkiyah2027';

        if ($request->isMethod('POST')) {
            $inputToken = (string) ($request->input('token') ?? $request->header('X-Setup-Token'));

            if (! hash_equals((string) $setupToken, $inputToken)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized setup token.',
                ], 403);
            }

            try {
                Artisan::call('migrate', ['--force' => true]);
                $migrationOutput = Artisan::output();

                if (! File::exists(public_path('storage'))) {
                    Artisan::call('storage:link');
                }

                Artisan::call('config:clear');
                Artisan::call('route:clear');
                Artisan::call('view:clear');

                return response()->json([
                    'status' => 'success',
                    'message' => 'System setup completed successfully.',
                    'migration_output' => $migrationOutput,
                ]);
            } catch (\Throwable $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ], 500);
            }
        }

        return response()->json([
            'status' => 'ready',
            'message' => 'Daar El Tazkiyah System Setup Helper is ready. Send POST with token to execute setup.',
        ]);
    }
}
