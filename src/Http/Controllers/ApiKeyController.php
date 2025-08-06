<?php

namespace Artapamudaid\SecureApiServer\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApiKeyController extends Controller
{
    public function generate(Request $request)
    {
        $userId = $request->id ?? null;

        $existing = DB::table('api_keys')->where('user_id', $userId)->first();

        if ($existing) {
            return response()->json([
                'message' => 'User already has an API key.',
                'key' => $existing->key,
                'secret' => $existing->secret,
            ]);
        }

        $key = $this->generateUniqueKey();
        $secret = Str::random(64);

        DB::table('api_keys')->insert([
            'user_id' => $userId,
            'key' => $key,
            'secret' => $secret,
            'revoked' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'message' => 'API key generated.',
            'key' => $key,
            'secret' => $secret,
        ]);
    }

    public function list()
    {
        $keys = DB::table('api_keys')->select('id', 'key', 'revoked', 'created_at', 'user_id')->get();

        return response()->json(['keys' => $keys]);
    }

    public function delete($id)
    {
        $deleted = DB::table('api_keys')->where('id', $id)->delete();

        return $deleted
            ? response()->json(['message' => 'API key deleted.'])
            : response()->json(['error' => 'API key not found.'], 404);
    }

    public function revoke($id)
    {
        $updated = DB::table('api_keys')->where('id', $id)->update(['revoked' => true]);

        return $updated
            ? response()->json(['message' => 'API key revoked.'])
            : response()->json(['error' => 'API key not found.'], 404);
    }

    protected function generateUniqueKey(): string
    {
        do {
            $key = Str::random(32);
            $exists = DB::table('api_keys')->where('key', $key)->exists();
        } while ($exists);

        return $key;
    }
}
