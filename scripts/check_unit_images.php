<?php
// Quick script to list units with missing image files
require __DIR__ . '/../vendor/autoload.php';

// Bootstrap the app
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Unit;

$units = Unit::all();
$out = [];
foreach ($units as $u) {
    $thumbCandidates = [];
    $publicFallback = public_path('images/placeholder-square.svg');
    $thumb = $publicFallback;
    if (!empty($u->image)) {
        $pubCandidate = public_path(ltrim($u->image, '/'));
        $thumbCandidates[] = $pubCandidate;
        if (file_exists($pubCandidate)) {
            $thumb = $pubCandidate;
        } else {
            $basename = basename($u->image);
            $samplePub = public_path('images/samples/' . $basename);
            $thumbCandidates[] = $samplePub;
            if (file_exists($samplePub)) {
                $thumb = $samplePub;
            } else {
                $storedPath = storage_path('app/public/' . ltrim($u->image, '/'));
                $thumbCandidates[] = $storedPath;
                if (file_exists($storedPath)) {
                    $thumb = $storedPath;
                }
            }
        }
    }
    $isPlaceholder = realpath($thumb) === realpath($publicFallback);
    if ($isPlaceholder) {
        $out[] = [ 'id' => $u->id, 'title' => $u->title, 'image' => $u->image, 'candidates' => $thumbCandidates ];
    }
}

if (count($out) === 0) {
    echo "All units have image candidates\n";
    exit(0);
}

foreach ($out as $row) {
    echo "Unit #{$row['id']} - {$row['title']}\n";
    echo "  image field: " . ($row['image'] ?? '(empty)') . "\n";
    echo "  checked paths:\n";
    foreach ($row['candidates'] as $p) echo "    - $p\n";
    echo "\n";
}

exit(0);
