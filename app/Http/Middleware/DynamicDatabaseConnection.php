<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;

class DynamicDatabaseConnection
{
    /**
     * This is custom handling multiple database dynamically
     *
     */
    public function handle($request, Closure $next)
    {
        // $selectedDatabase = $request->input('selectedDB');
        // $selectedDatabase = session('selectedDatabase', $request->input('selectDB'));
         // Check if the user has provided a database in the request
        $selectedDatabase = $request->input('selectedDB');
        
        $allowedDatabases = [
            'db_lu' => 'DB_LU',
            'db_vital' => 'DB_VITAL'
        ];
        
        if ($selectedDatabase && array_key_exists($selectedDatabase, $allowedDatabases)) {
            // session(['selectedDatabase' => $selectedDatabase]);
            session(['selected_database' => $selectedDatabase]);
            
        } else {
            // Get the database from the session if not provided in the request
            $selectedDatabase = session('selected_database');
        } 
        
        // else {
        //     return response()->json(['message' => 'Invalid database selected'], 400);
        // }

        if (!$selectedDatabase) {
            return response()->json(['message' => 'No database selected'], 400);
        }

        $connectionName = $allowedDatabases[$selectedDatabase];
        // config(['app.db_connection' => $connectionName]);
        $connectionConfig = [
            'driver'   => 'pgsql',
            'host'     => env('DB_HOST'),
            'port'     => env($connectionName . '_PORT', 25060),
            'database' => env($connectionName . '_DATABASE'),
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
        ];
        // Dynamically set the database connection for this request
        Config::set('database.connections.dynamic', $connectionConfig);
        Config::set('database.default', 'dynamic');

        return $next($request);
    }
}
