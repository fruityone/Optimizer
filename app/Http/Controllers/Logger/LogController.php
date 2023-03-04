<?php

namespace App\Http\Controllers\Logger;

use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\File;

class LogController extends Controller
{
    public function showLogs()
    {
        $logData = File::get(storage_path('logs/requests.log'));

        $perPage = 20;
        $currentPage = Paginator::resolveCurrentPage();
        $logs = new LengthAwarePaginator(
            array_slice(explode("\n", $logData), 0, -1),
            count(explode("\n", $logData)),
            $perPage,
            $currentPage,
            ['path' => Paginator::resolveCurrentPath()]
        );
        return view('logs', [
            'logLines' => $logs,
        ]);
    }
}
